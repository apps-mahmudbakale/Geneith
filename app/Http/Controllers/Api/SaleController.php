<?php

namespace App\Http\Controllers\Api;

use App\Models\Sale;
use NumberFormatter;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPrice(Request $request)
    {
        // dd($request->all());

        $product = Product::find($request->prid);
        $items = DB::table('station_products')
                            ->where('product_id', $request->prid)
                            ->first();

        $amount = $product->selling_price * $request->qty;

        $update = DB::table('sales_order')
                        ->where('product_id', $request->prid)
                        ->where('invoice', $request->invoice)
                        ->update([
                            'quantity' => $request->qty,
                            'amount' => $amount,
                        ]);
        $getAmount = DB::table('sales_order')
                        ->where('product_id', $request->prid)
                        ->where('invoice', $request->invoice)
                        ->first();
        $getSum = DB::table('sales_order')
                        ->selectRaw('sum(amount) as total')
                        ->where('invoice', $request->invoice)
                        ->first();
        $a = number_format($getAmount->amount, 2);
        $b = number_format($getSum->total, 2);
        $format = new NumberFormatter("En", NumberFormatter::SPELLOUT);
        $words = strtoupper($format->format($getSum->total))." NAIRA ONLY";
        
        // dd($words);

        if($request->qty < $items->quantity){

            $data = array('amount' =>$a,'total'=>$b, 'text'=>$words, 'qty'=> $request->qty, 'msg' => 'success');
        }else if($request->qty > $items->quantity){
            $data = array('amount' =>$a,'total'=>$b, 'text'=>$words, 'qty'=> $request->qty, 'msg' => 'excess');
        } 

        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSales($station)
    {
        $sales = Sale::where('station_id', $station)
        ->where('synced', 0)
        ->get();

        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = Sale::create([
            'invoice' => $request->invoice,
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'amount'  => $request->amount,
            'qty' => $request->qty,
            'station_id' => $request->station_id,
            'created_at' => $request->created_at,
        ]);

        return response()->json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
