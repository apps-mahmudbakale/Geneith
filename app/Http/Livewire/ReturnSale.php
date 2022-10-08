<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;

class ReturnSale extends Base
{
    public $sortBy = 'invoice';
    public function render()
    {
        if ($this->search) {
            $invoices = Invoice::query()
                ->where('invoice', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.return-sale',
                ['invoices' => $invoices]
            );
        } else {
            $invoices = Invoice::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.return-sale',
                ['invoices' => $invoices]
            );
        }
    }
}
