<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Sales extends Base
{
    public $sortBy = 'products.name';
    public function render()
    {
        if(auth()->user()->hasRole('admin|store')){
            if ($this->search) {
                $sales = DB::table('sales')
                    ->select('sales.*','products.name as product','users.name as user', 'stations.name as station')
                    ->join('products', 'products.id', '=', 'sales.product_id')
                    ->join('stations', 'stations.id', '=', 'sales.station_id')
                    ->join('users', 'users.id', '=', 'sales.user_id')
                    ->where('products.name', 'like', '%' . $this->search . '%')
                    ->paginate(10);
    
                return view(
                    'livewire.sales',
                    ['sales' => $sales]
                );
            } else {
                $sales = DB::table('sales')
                    ->select('sales.*','products.name as product','users.name as user', 'stations.name as station')
                    ->join('products', 'products.id', '=', 'sales.product_id')
                    ->RightJoin('stations', 'stations.id', '=', 'sales.station_id')
                    ->join('users', 'users.id', '=', 'sales.user_id')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
                return view(
                    'livewire.sales',
                    ['sales' => $sales]
                );
            }
        }else{
            if ($this->search) {
                $sold = DB::table('sales')
                        ->select(DB::raw('SUM(amount) as total'))
                        ->where('sales.station_id', auth()->user()->station->id)
                        ->where('sales.user_id', auth()->user()->id)
                        ->first();
                $sales = DB::table('sales')
                ->select('sales.*','products.name as product','station_products.quantity as remaining', 'stations.name as station')
                    ->join('products', 'products.id', '=', 'sales.product_id')
                    ->join('station_products', 'station_products.product_id', '=', 'sales.product_id')
                    ->join('stations', 'stations.id', '=', 'sales.station_id')
                    ->join('users', 'users.id', '=', 'sales.user_id')
                    ->where('sales.station_id', auth()->user()->station->id)
                    ->where('sales.user_id', auth()->user()->id)
                    ->where('products.name', 'like', '%' . $this->search . '%')
                    ->paginate(10);
                return view(
                    'livewire.sales',
                    ['sales' => $sales, 'sold' => $sold->total]
                );
            } else {
                $sold = DB::table('sales')
                                ->select(DB::raw('SUM(amount) as total'))
                                ->where('sales.station_id', auth()->user()->station->id)
                                ->where('sales.user_id', auth()->user()->id)
                                ->first();
                                // dd($sold->total);
                $sales = DB::table('sales')
                ->select('sales.*','products.name as product','station_products.quantity as remaining', 'stations.name as station')
                ->join('products', 'products.id', '=', 'sales.product_id')
                ->join('station_products', 'station_products.product_id', '=', 'sales.product_id')
                ->join('stations', 'stations.id', '=', 'sales.station_id')
                ->join('users', 'users.id', '=', 'sales.user_id')
                ->where('sales.station_id', auth()->user()->station->id)
                ->where('sales.user_id', auth()->user()->id)
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
                return view(
                    'livewire.sales',
                    ['sales' => $sales, 'sold' => $sold->total]
                );
            }
        }
    }
}
