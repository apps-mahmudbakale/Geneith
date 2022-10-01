<?php

namespace App\Imports;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection,  WithHeadingRow
{
    public function collection(Collection $rows)
    {
        if(auth()->user()->hasRole('admin|store')){
            foreach ($rows as $row) 
            {
                $store = Store::where('name', $row['store'])->first();
                Product::create([
                    'store_id' => $store->id,
                    'name' => $row['product'],
                    'buying_price' => $row['cost'],
                    'selling_price' => $row['cost'] * 1.6,
                    'qty' => $row['quantity'],
                    'expiry_date' => $row['expiry'],
                ]);
            }
        }else{
            // dd($rows);
            foreach ($rows as $row){
                DB::table('station_products')
                ->insert([
                    'station_id' => auth()->user()->station->id,
                    'product_id' => $row['product'],
                    'quantity' => $row['qty']
                ]);

               $product = DB::table('products')
                ->where('id', $row['product']);
                $product->decrement('qty');
            }
           
        }

    }
}

