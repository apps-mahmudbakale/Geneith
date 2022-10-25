<?php

namespace App\Exports;

use App\Models\Requests;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequestsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $reference;
    public function __construct($reference)
    {
        $this->reference = $reference;
    }

    public function headings(): array
    {
        return [
            'Product',
            'Approved',
        ];
    }

    public function collection()
    {
        return Requests::where('request_ref', '=', $this->reference)->get(['product_id', 'approved_qty']);
    }
}
