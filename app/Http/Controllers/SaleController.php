<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.index');
    }

    public function createRandomPassword()
    {
        $chars = "003232303232023232023456789";
        srand((float)microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {

            $num = rand() % 33;

            $tmp = substr($chars, $num, 1);

            $pass = $pass . $tmp;

            $i++;
        }
        return $pass;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (empty(session('invoice'))) {
            session()->put('invoice', 'RS-' . $this->createRandomPassword());
        }
        $invoice = session()->get('invoice');
        return view('sales.create', compact('invoice'));
    }

    public function searchItem(Request $request)
    {

        $keyword = trim($request->search_keyword, "");

        $products = DB::table('station_products')
            ->join('products', 'products.id', '=', 'station_products.product_id')
            ->where('products.name', 'like', '%' . $keyword . '%')
            ->get();
        echo '<ul class="nav flex-column">';
        foreach ($products as $product) {
            $url = base64_encode($product->product_id . ',' . session()->get('invoice') . ',' . $product->selling_price);
            echo '<li class="nav-item">
                <a href="' . route('app.sales.cart', $url) . '" class="nav-link">
                  <strong>' . $product->name . '</strong>
                  <span class="float-right badge bg-primary">&#8358; ' . number_format($product->selling_price, 2) . '</span>
                </a>
              </li>';
        }
        echo '</ul>';
    }

    public function cart($invoice)
    {
        $data = explode(',', base64_decode($invoice));
        // dd($data);
        $qty = 1;
        $cart = DB::table('sales_order')
            ->updateOrInsert(
                ['product_id' => $data[0], 'invoice' => $data[1]],
                [
                    'quantity' => DB::raw('quantity + '.$qty),
                    'amount' => DB::raw('amount + '.$data[2]),
                    'created_at' => DB::raw('now()'),
                    'updated_at' => DB::raw('now()'),
                ]
            );

        return redirect()->route('app.sales.create');
    }
    public function saveSale($invoice)
    {
        $sales_order = DB::table('sales_order')
                            ->where('invoice', $invoice)
                            ->get();
        foreach ($sales_order as $order){
            $sales = Sale::create([
                'invoice' => $invoice,
                'product_id' => $order->product_id,
                'qty' => $order->quantity,
                'amount' => $order->amount,
                'user_id' => 1
            ]);
            $product = DB::table('products')
                            ->where('id',  $order->product_id)
                            ->update(['qty' => DB::raw('qty - '.$order->quantity)]);
        }
        $invoice = Invoice::create([
            'invoice' => $invoice,
            'created_at' => now(),
        ]);
        DB::table('sales_order')->where('invoice', $invoice)->delete();
        session()->forget('invoice');
        return redirect()->route('app.sales.create')->with('success', 'Sales Saved');
    }
    public function saveSalePrint($invoice)
    {
        $sales_order = DB::table('sales_order')
                            ->where('invoice', $invoice)
                            ->get();
        foreach ($sales_order as $order){
            $sales = Sale::create([
                'invoice' => $invoice,
                'product_id' => $order->product_id,
                'qty' => $order->quantity,
                'amount' => $order->amount,
                'user_id' => 1
            ]);
            $product = DB::table('products')
                            ->where('id',  $order->product_id)
                            ->update(['qty' => DB::raw('qty - '.$order->quantity)]);
        }
        $invoices = Invoice::create([
            'invoice' => $invoice,
            'created_at' => now(),
        ]);
        DB::table('sales_order')->where('invoice', $invoice)->delete();
        session()->forget('invoice');
        return redirect()->route('app.sales.print', $invoice);
    }

    public function cancelSale($invoice)
    {
        DB::table('sales_order')->where('invoice', $invoice)->delete();
        session()->forget('invoice');
        return redirect()->route('app.sales.create');
    }

    public function printInvoice($invoice)
    {
        $items = DB::table('sales')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->where('sales.invoice', $invoice)
            ->get();

        return view('sales.print', compact('items'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
