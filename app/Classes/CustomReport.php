<?php
namespace App\Classes;

use NumberFormatter;
use Illuminate\Support\Facades\DB;

class CustomReport 
{
  
    public function filter($request)
    {
        $query = DB::table('sales')
            ->select('sales.*', 'products.name as product', 'users.name as user', 'stations.name as station')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->join('stations', 'stations.id', '=', 'sales.station_id')
            ->join('users', 'users.id', '=', 'sales.user_id');

            if($request->has('product') && !empty($request->product))
            {
                $query->where('products.id', $request->product);
            }

            if($request->has('station') && !empty($request->station))
            {
                $query->where('stations.id', $request->station);
            }

            if($request->has('user') && !empty($request->user))
            {
                $query->where('users.id', $request->user);
            }

            if($request->has('date') && !empty($request->date))
            {
                $query->where('sales.created_at', $request->date);
            }

            $sum = DB::table('sales')
            ->selectRaw('sum(sales.amount) as total')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->join('stations', 'stations.id', '=', 'sales.station_id')
            ->join('users', 'users.id', '=', 'sales.user_id');

            if($request->has('product') && !empty($request->product))
            {
                $query->where('products.id', $request->product);
            }

            if($request->has('station') && !empty($request->station))
            {
                $query->where('stations.id', $request->station);
            }

            if($request->has('user') && !empty($request->user))
            {
                $query->where('users.id', $request->user);
            }

            if($request->has('date') && !empty($request->date))
            {
                $query->where('sales.created_at', $request->date);
            }
            
        $sum->first();
        $inWords = new NumberFormatter("En", NumberFormatter::SPELLOUT);
        $words = $inWords->format($sum->first()->total);
            return  [
             'filter' =>  $query->get(),
             'words' => $words,
             'sum' => $sum->first()->total
            ];
            
    }

    public function monthlyReport(){
        $report = DB::table('requests')
        ->selectRaw('DISTINCT products.name as product')
        ->join('products', 'requests.product_id', '=', 'products.id')
        ->join('stations', 'requests.station_id', '=', 'stations.id')
        ->join('station_products', 'stations.id', '=', 'station_products.station_id')
        ->where('stations.id', '1')
        ->where('requests.status', 'approved')
        // ->whereRaw('sales.created_at BETWEEN date("2022-10-07") AND date("2022-11-07")')
        ->get()->toArray();
        $reports = DB::table('requests')
        ->selectRaw('DISTINCT station_products.quantity as quantity, requests.approved_qty, (requests.approved_qty) - (station_products.quantity) as sold, products.buying_price, products.selling_price, requests.approved_qty * products.buying_price, requests.approved_qty * products.selling_price, (requests.approved_qty * products.selling_price) - (requests.approved_qty * products.buying_price)')
        ->join('products', 'requests.product_id', '=', 'products.id')
        ->join('stations', 'requests.station_id', '=', 'stations.id')
        ->join('station_products', 'stations.id', '=', 'station_products.station_id')
        ->where('stations.id', '1')
        ->where('requests.status', 'approved')
        // ->whereRaw('sales.created_at BETWEEN date("2022-10-07") AND date("2022-11-07")')
        ->get()->toArray();
        
        return array_merge($report, $reports);
    }
}