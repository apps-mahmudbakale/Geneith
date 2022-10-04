<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReturnSale extends Base
{
    public $sortBy = 'invoice';
    public function render()
    {
        if ($this->search) {
            $invoices = InvoiceModel::query()
                ->where('invoice', 'like', '%' . $this->search . '%')
                ->paginate(10);

            return view(
                'livewire.return-sale',
                ['invoices' => $invoices]
            );
        } else {
            $invoices = InvoiceModel::query()
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage);
            return view(
                'livewire.return-sale',
                ['invoices' => $invoices]
            );
        }
    }
}
