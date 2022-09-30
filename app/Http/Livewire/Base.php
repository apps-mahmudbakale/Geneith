<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Base extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $sortDirection = 'asc';

    public $perPage = 10;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection == 'desc';
        } else {
            $this->sortDirection == 'asc';
        }
        return $this->sortBy = $field;
    }
}
