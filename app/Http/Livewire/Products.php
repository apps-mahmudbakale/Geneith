<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Products extends Base
{
    public $sortBy = 'products.name';
    public function render()
    {
        if(auth()->user()->hasRole('admin|store')){
            if ($this->search) {
                $products = Product::query()
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->Orwhere('buying_price', 'like', '%' . $this->search . '%')
                    ->Orwhere('selling_price', 'like', '%' . $this->search . '%')
                    ->Orwhere('qty', 'like', '%' . $this->search . '%')
                    ->Orwhere('expiry_date', 'like', '%' . $this->search . '%')
                    ->paginate(10);
    
                return view(
                    'livewire.products',
                    ['products' => $products]
                );
            } else {
                $products = Product::query()
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
                return view(
                    'livewire.products',
                    ['products' => $products]
                );
            }
        }else{
            if ($this->search) {
               $products = DB::table('station_products')
                    ->join('products', 'products.id', '=', 'station_products.product_id')
                    ->where('products.name', 'like', '%' . $this->search . '%')
                    ->paginate(10);
    
                return view(
                    'livewire.products',
                    ['products' => $products]
                );
            } else {
                $products = DB::table('station_products')
                    ->join('products', 'products.id', '=', 'station_products.product_id')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
                return view(
                    'livewire.products',
                    ['products' => $products]
                );
            }
        }
    }
}
