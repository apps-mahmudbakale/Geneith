<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsSpecialImport;
use App\Http\Requests\ProductsFormRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $this->authorize('read-products');

        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::get();

        return view('products.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsFormRequest $request)
    {
        // dd(array_merge($request->except('expiry_date'), ['expiry_date' => date($request->expiry_date)]));
        $products = Product::create(array_merge($request->except('expiry_date'), ['expiry_date' => date($request->expiry_date)]));

        return redirect()->route('app.products.index')->with('success', 'Product Added');
    }

    public function import(Request $request)
    {
        Excel::import(new ProductsImport, $request->file('csv')->store('files'));
        return redirect()->route('app.products.index')->with('success', 'Products Imported');
    }

    public function importSpecial(Request $request)
    {
        Excel::import(new ProductsSpecialImport, $request->file('csv')->store('files'));
        return redirect()->route('app.products.index')->with('success', 'Products Imported');
    }

    public function export(Request $request)
    {
        return Excel::download(new ProductsExport(), 'products-'.date('m-d-Y').'.xlsx');
        // return (new ProductsExport)->download('products-'.date('m-d-Y').'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function importView()
    {
        return view('products.import');
    }

    public function importSpecialView()
    {
        return view('products.import-special');
    }

    public function print()
    {
        $products = Product::all();
        return view('products.print', compact('products'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $stores = Store::get();

        return view('products.edit', compact('stores', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsFormRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('app.products.index')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with('success', 'Product Deleted');
    }
}
