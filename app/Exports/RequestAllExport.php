<?php

namespace App\Exports;

use App\Models\Station;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RequestAllExport implements  WithMultipleSheets
{

    public function sheets(): array
    {
        $sheets = [];
        $stations = Station::all();
        foreach($stations as $station){
            $sheets[] = new RequestsPerStationSheet($station->id, $station->name);
        }

        return $sheets;
    }
}
