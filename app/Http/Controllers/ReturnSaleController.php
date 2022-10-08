<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = DB::table('return_request')
        ->selectRaw('DISTINCT invoice, status, date(created_at) as date')
        ->get();
        return view('sales-return.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('sales-return.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->hasRole('admin')){
            foreach ($request->items as $index => $item) {
                DB::table('return_request')
                    ->where('invoice', $request->invoice)
                    ->where('product_id', $request->items[$index])
                    ->update([
                        'return_qty' => $request->rqty[$index],
                        'status' => true,
                        'updated_at' => now()
                    ]);

                    $sales = DB::table('sales')
                                ->where('invoice', $request->invoice)
                                ->where('product_id', $request->items[$index])
                                ->first();
                    if($sales->qty == 1){
                        DB::table('sales')
                                ->where('invoice', $request->invoice)
                                ->where('product_id', $request->items[$index])
                                ->delete();
                        $data = DB::table('return_request')->where('product_id', $request->items[$index])->first();
                        DB::table('station_products')
                            ->where('product_id', $request->items[$index])
                            ->where('station_id', $data->station_id)
                            ->update(['quantity' => DB::raw('quantity + 1')]);
                    }else{
                    $product = DB::table('products')
                                ->where('id', $request->items[$index])->first();
                    DB::table('sales')
                            ->where('invoice', $request->invoice)
                            ->where('product_id', $request->items[$index])
                            ->update(['qty' => DB::raw('qty -'.$request->rqty[$index]), 'amount' => $product->selling_price * $request->rqty[$index]]);
                    $data = DB::table('return_request')->where('product_id', $request->items[$index])->first();
                    DB::table('station_products')
                        ->where('product_id', $request->items[$index])
                        ->where('station_id', $data->station_id)
                        ->update(['quantity' => DB::raw('quantity +'.$request->rqty[$index])]);
                    }
    
            }
            return redirect()->route('app.returns.index')->with('success', 'Return Request Sent');
        }else{
            foreach ($request->items as $index => $item) {
                DB::table('return_request')
                    ->insert([
                        'invoice' => $request->invoice,
                        'product_id' => $request->items[$index],
                        'return_qty' => $request->rqty[$index],
                        'station_id' => auth()->user()->station->id,
                        'created_at' => now()
                    ]);
    
            }
            return redirect()->route('app.returns.index')->with('success', 'Return Request Sent');
        }


        
        
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        if(auth()->user()->hasRole('admin')){
            $requests = DB::table('return_request')->where('invoice', $invoice)->pluck('product_id')->toArray();
            $done = DB::table('return_request')->where('invoice', $invoice)->first();
            // dd($requests);
            $items = DB::table('sales')
            ->select('sales.*','products.name as product', 'products.selling_price')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->where('sales.invoice', $invoice)
            ->get();
            return view('sales-return.show', compact('items', 'requests', 'done'));
        }else{
            
            $done = DB::table('return_request')->where('invoice', $invoice)->first();
            if(!empty($done)){
                $requests = DB::table('return_request')->where('invoice', $invoice)->pluck('product_id')->toArray();
                $items = DB::table('sales')
                ->select('sales.*','products.name as product', 'products.selling_price', 'return_request.*')
                ->join('products', 'products.id', '=', 'sales.product_id')
                ->join('return_request', 'return_request.product_id', '=', 'products.id')
                ->where('sales.invoice', $invoice)
                ->get();
                return view('sales-return.show', compact('items', 'requests', 'done'));
            }else{
                $items = DB::table('sales')
                ->select('sales.*','products.name as product', 'products.selling_price', 'return_request.*')
                ->join('products', 'products.id', '=', 'sales.product_id')
                ->where('sales.invoice', $invoice)
                ->get();
                return view('sales-return.show', compact('items'));
            }
           
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($invoice)
    {
        $items = DB::table('sales')
        ->select('sales.*','products.name as product', 'products.selling_price')
        ->join('products', 'products.id', '=', 'sales.product_id')
        ->where('sales.invoice', $invoice)
        ->get();

        return view('sales-return.edit', compact('items'));
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
