<?php

namespace App\Http\Livewire\Employee\Ordenes;

use App\Models\Orden;
use App\Models\Persona;
use Livewire\Component;

class OrdenLista extends Component
{
    public $ordenes, $clientes;

    public function mount()
    {
        $this->ordenes = Orden::all();
        $this->clientes = Persona::whereIn('id', $this->ordenes->pluck('cliente_id'))->get();

    }


    public function render()
    {
        return view('livewire.employee.ordenes.orden-lista');
    }
}
