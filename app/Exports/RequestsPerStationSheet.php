<?php

namespace App\Exports;

use App\Models\Requests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestsPerStationSheet implements FromCollection, WithHeadings, WithTitle
{

    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name  = $name;
    }

    public function headings(): array
    {
        return [
            'Product',
            'Approved Quantity',
            'Buying Price',
            'Selling Price',
            'Total Sales',
            'Total Cost',
            'Gross'
        ];
    }
    
    public function collection()
    {
       $requestAll = DB::table('requests')
                ->select('products.name as product', 'requests.request_qty', 'products.buying_price', 'products.selling_price', DB::raw('requests.approved_qty * products.selling_price'), DB::raw('requests.approved_qty * products.buying_price'))
                ->join('products', 'requests.product_id', '=', 'products.id')
                ->join('stations', 'requests.station_id', '=', 'stations.id')
                ->where('requests.station_id', $this->id)
                ->where('requests.status', 'approved')
                ->get();
        return $requestAll;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->name;
    }
}
