<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;

class Sales extends Component
{
    public $sortBy = 'products.name';
    public function render()
    {
        if(auth()->user()->hasRole('admin|store')){
            if ($this->search) {
                $products = DB::table('sales')
                    ->join('products', 'products.id', '=', 'station_products.product_id')
                    ->where('products.name', 'like', '%' . $this->search . '%')
                    ->paginate(10)
    
                return view(
                    'livewire.products',
                    ['products' => $products]
                );
            } else {
                $products = Sale::query()
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
