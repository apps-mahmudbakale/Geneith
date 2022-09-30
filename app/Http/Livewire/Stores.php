<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class Stores extends Base
{
    public $sortBy = 'name';
    public function render()
    {
        if ($this->search) {
            $stores = Store::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->Orwhere('location', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.stores',
                ['stores' => $stores]
            );
        } else {
            $stores = Store::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.stores',
                ['stores' => $stores]
            );
        }
    }
}
