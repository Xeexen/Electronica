<?php

namespace App\Http\Livewire\Employee\Facturas;

use App\Models\Factura;
use App\Models\Persona;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacturasLista extends Component
{
    use LivewireAlert;

    public $facturas, $clientes;

    public function mount()
    {
        $this->clientes = Persona::where('tipoPersona->cliente', true)->get();
        $this->facturas = Factura::all();
    }

    public function render()
    {
        return view('livewire.employee.facturas.facturas-lista')->layout('layouts.admin');
    }
}
