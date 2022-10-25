<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsSpecialImport implements ToCollection,  WithHeadingRow
{
    public function collection(Collection $rows)
    {
            foreach ($rows as $row) 
            {
                $store = Store::where('name', $row['store'])->first();
                Product::updateOrCreate(
                    ['store_id' => $store->id, 'name' => ucfirst($row['product'])],
                    [
                    'buying_price' => $row['buying'],
                    'selling_price' => $row['selling'],
                    'qty' => $row['quantity'],
                    'expiry_date' => $row['expiry'],
                ]);
            }

            // dd($rows);
           

    }
}
