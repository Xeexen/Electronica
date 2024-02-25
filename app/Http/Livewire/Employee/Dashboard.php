<?php

namespace App\Http\Livewire\Employee;

use App\Models\Persona;
use Livewire\Component;
use App\Http\Livewire\Employee\Personas\Personas;

class Dashboard extends Component
{
    public $periods = 7;

    public $clientes;

    public function mount()
    {
        $clientes = Persona::all();
    }

    public function render()
    {
        return view('livewire.employee.dashboard')->layout('layouts.admin');
    }
}
