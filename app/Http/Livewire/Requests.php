<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Requests as ModelsRequests;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Requests extends Component
{
    public function render()
    {
        if(auth()->user()->hasRole('store|admin'))
        {
            $requests = DB::table('requests')
            ->selectRaw('DISTINCT requests.request_ref, requests.status, date(requests.created_at) as date, stations.name, users.name as user')
            ->join('stations', 'stations.id', '=', 'requests.station_id')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->get();
            return view('livewire.requests', ['requests' => $requests]);
        }
        else
        {
            $requests = DB::table('requests')
            ->selectRaw('DISTINCT request_ref, status,  date(created_at) as date')
            ->where('station_id', '=', auth()->user()->station->id)
            ->get();
            return view('livewire.requests', ['requests' => $requests]);
        }
        
    }
}
