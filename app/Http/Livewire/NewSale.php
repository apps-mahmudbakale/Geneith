<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NewSale extends Component
{
    public function render()
    {
        $invoice = session()->get('invoice');
        $carts = DB::table('sales_order')
            ->select('sales_order.*','products.id as product_id','products.name', 'products.selling_price')
            ->join('products', 'products.id', '=', 'sales_order.product_id')
            ->where('sales_order.invoice', $invoice)
            ->get();
        $getSum = DB::table('sales_order')
            ->selectRaw('sum(amount) as total')
            ->where('invoice', $invoice)
            ->first();
        return view('livewire.new-sale', ['carts' => $carts, 'getSum' =>$getSum]);
    }
}
