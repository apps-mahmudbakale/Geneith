<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequestAllExport implements  FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'Station',
            'Product',
            'Approved Quantity',
            'Buying Price',
            'Selling Price'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $requestAll = DB::table('requests')
                ->select('stations.name as station','products.name as product', 'requests.request_qty', 'products.buying_price', 'products.selling_price')
                ->join('products', 'requests.product_id', '=', 'products.id')
                ->join('stations', 'requests.station_id', '=', 'stations.id')
                ->get();
        return $requestAll;
    }
}
