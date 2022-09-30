<?php

namespace App\Http\Livewire;

use App\Models\Station;
use Livewire\Component;

class Stations extends Base
{
    public $sortBy = 'name';
    public function render()
    {
        if ($this->search) {
            $stations = Station::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.stations',
                ['stations' => $stations]
            );
        } else {
            $stations = Station::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.stations',
                ['stations' => $stations]
            );
        }
    }
}
