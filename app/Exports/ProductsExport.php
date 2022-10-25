<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Store',
            'Product',
            'Buying',
            'Selling',
            'Quantity',
            'Expiry'
        ];
    }
    public function collection()
    {
        
        $products = Product::query()
                    ->join('stores', 'stores.id', '=', 'products.store_id')
                    ->select('stores.name as store','products.name', 'products.buying_price', 'products.selling_price', 'products.qty', 'products.expiry_date')
                    ->get();
        return $products;
    }
}
