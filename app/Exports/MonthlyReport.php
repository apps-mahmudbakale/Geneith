<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MonthlyReport implements FromCollection, WithHeadings
{

    public $station;
    public $fromDate;
    public $toDate;

    public function __construct($station, $fromDate, $toDate)
    {
        $this->station = $station;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function headings(): array
    {
        return [
            'Product',
            'Approved Quantity',
            'Buying Price',
            'Selling Price',
            'Qunatity Sold',
            'Quantity Remaining',
            'Total Cost Price of Goods Sold',
            'Total Selling Price of Goods Sold',
            'Gross'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $report = DB::table('requests')
        ->selectRaw(' DISTINCT products.name as product, requests.approved_qty, products.buying_price, products.selling_price, (requests.approved_qty) - (station_products.quantity) as sold, station_products.quantity as quantity, products.buying_price, products.selling_price, requests.approved_qty * products.buying_price, requests.approved_qty * products.selling_price, (requests.approved_qty * products.selling_price) - (requests.approved_qty * products.buying_price)')
        ->join('products', 'requests.product_id', '=', 'products.id')
        ->join('stations', 'requests.station_id', '=', 'stations.id')
        ->join('sales', 'sales.station_id', '=', 'stations.id')
        ->join('station_products', 'stations.id', '=', 'station_products.station_id')
        ->where('requests.station_id', '1')
        ->where('requests.status', 'approved')
        ->whereRaw('sales.created_at BETWEEN date("2022-10-07") AND date("2022-11-07")')
        ->get();

        return $report;
    }
}
