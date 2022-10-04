<?php

namespace App\Http\Livewire;

use App\Models\Invoice AS InvoiceModel;
use Livewire\Component;

class Invoice extends Base
{
    public $sortBy = 'invoice';
    public function render()
    {
        if ($this->search) {
            $invoices = InvoiceModel::query()
                ->where('invoice', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.invoice',
                ['invoices' => $invoices]
            );
        } else {
            $invoices = InvoiceModel::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.invoice',
                ['invoices' => $invoices]
            );
        }
    }
}
