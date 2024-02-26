<?php

namespace App\Http\Livewire\Employee;

use App\Models\Orden;
use App\Models\Factura;
use App\Models\Persona;
use Livewire\Component;
use App\Http\Livewire\Employee\Personas\Personas;

class Dashboard extends Component
{
    public $clientes, $ordenes, $facturas;

    public function mount()
    {
        $this->facturas = Factura::all();
        $this->ordenes = Orden::all();
        $this->clientes = Persona::all();
    }

    public function render()
    {
        return view('livewire.employee.dashboard')->layout('layouts.admin');
    }
}
