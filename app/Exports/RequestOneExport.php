<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequestOneExport implements FromCollection, WithHeadings
{
    public $ref;

    public function __construct($ref)
    {
        $this->ref  = $ref;
    }

    public function headings(): array
    {
        return [
            'Product',
            'Approved Quantity',
            'Buying Price',
            'Selling Price',
            'Total Cost Price of Goods Collected',
            'Total Selling Price of Goods Collected',
            'Gross'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $requestAll = DB::table('requests')
            ->select('products.name as product', 'requests.request_qty', 'products.buying_price', 'products.selling_price', DB::raw('requests.approved_qty * products.buying_price'), DB::raw('requests.approved_qty * products.selling_price'), DB::raw('(requests.approved_qty * products.selling_price) - (requests.approved_qty * products.buying_price)'))
            ->join('products', 'requests.product_id', '=', 'products.id')
            ->join('stations', 'requests.station_id', '=', 'stations.id')
            ->where('requests.request_ref', $this->ref)
            ->where('requests.status', 'approved')
            ->get();
        return $requestAll;
    }
}
