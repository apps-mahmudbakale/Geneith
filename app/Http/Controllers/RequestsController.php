<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Requests;
use Illuminate\Http\Request;
use App\Imports\RequestImport;
use App\Exports\RequestsExport;
use App\Exports\RequestAllExport;
use App\Exports\RequestOneExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requests.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('requests.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ref = uniqid();
        foreach($request->items as $index => $item){
            $requests = Requests::create([
                'station_id' => auth()->user()->station->id,
                'user_id' => auth()->user()->id,
                'product_id' => $item,
                'request_qty' => $request->qty[$index],
                'approved_qty' => 0,
                'request_ref' => $ref 
            ]);
        }
        
        return redirect()->route('app.requests.index')->with('success', 'Request Sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show($ref)
    {
        $request = DB::table('requests')
        ->join('products', 'products.id', '=', 'requests.product_id')
        ->where('requests.request_ref', $ref)
        ->get();
        $s = DB::table('requests')
        ->where('request_ref', $ref)
        ->first();
        $status = $s->status;
        // dd($request);

        return view('requests.show', compact('request', 'status', 'ref'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }


    public function approve(Request $request, $ref){
       $requests = Requests::where('request_ref', $ref)
       ->pluck('product_id');

       foreach($request->items as $index => $item){
            $approve = DB::table('requests')
                ->where('request_ref', $ref)
                ->where('product_id', $requests[$index])
                ->update([
                    'approved_qty' =>$request->approved_qty[$index],
                    'status' => 'approved'
                ]);
       }

       return redirect()->route('app.requests.index')->with('success','Request Approved');
    }

    public function acknowledge($ref)
    {
       

        $requests = Requests::where('request_ref', $ref)->get();
        return Excel::download(new RequestsExport($ref), date('d-m-Y').'.xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        //
    }

    public function import(Request $request)
    {
        Excel::import(new RequestImport, $request->file('csv')->store('files'));
        return redirect()->route('app.requests.index')->with('success', 'Requests Imported');
    }

    public function importView()
    {
        return view('requests.import');
    }

    public function exportsAll(){

      return Excel::download(new RequestAllExport(), 'AllRequests.xlsx');
    }

    public function exportsOne($ref){
        //  dd($ref);
        return Excel::download(new RequestOneExport($ref), 'IndividualRequests-'.$ref.'.xlsx');
      }

    //   public function deleteRequest($ref){
    //     DB::table('requests')->where('request_ref', $ref)->delete();
       
    //   }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy($ref)
    {
        DB::table('requests')->where('request_ref', $ref)->delete();
        return redirect()->route('app.requests.index')->with('success', 'Request Deleted');
        // dd($ref);
    }
}
