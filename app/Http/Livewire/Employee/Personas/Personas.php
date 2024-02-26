<?php

namespace App\Http\Livewire\Employee\Personas;

use App\Models\Persona;
use Livewire\Component;

class Personas extends Component
{
    public $personas;

    public function mount(){
        $this->personas = Persona::all();
    }

    public function render()
    {
        return view('livewire.employee.personas.personas')->layout('layouts.admin');
    }
}
