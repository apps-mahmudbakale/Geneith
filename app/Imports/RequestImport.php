<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Station;
use App\Models\Requests;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RequestImport implements ToCollection,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows) 
    {
        $ref = uniqid();
        // dd($rows);
        foreach ($rows as $row) 
        {
            $product = Product::where('name', $row['product'])->first();
            $station = Station::where('name', $row['station'])->first();
            Requests::updateOrCreate(
                ['request_ref' => $ref, 'product_id' => $product->id, 'station_id' => $station->id],
                [
                'request_qty' => $row['requested'],
                'approved_qty' => $row['issued'],
                'user_id' => auth()->user()->id,
                'status' => 'approved',
            ]);
        }
    }
}
