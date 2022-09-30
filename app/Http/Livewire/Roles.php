<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class Roles extends Base
{
    public $sortBy = 'name';
    public function render()
    {
        if ($this->search) {
            $roles = Role::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.roles',
                ['roles' => $roles]
            );
        } else {
            $roles = Role::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.roles',
                ['roles' => $roles]
            );
        }
    }
}
