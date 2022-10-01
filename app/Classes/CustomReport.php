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
}