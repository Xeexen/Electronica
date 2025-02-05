<?php

namespace App\Http\Livewire\Customer;

use App\Models\Orden;
use App\Models\Persona;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrdenLista extends Component
{
    public $ordenes;
    public $persona;

    public function mount()
    {
        $this->persona = Persona::where('usuario_id', Auth::user()->id)->first();
        if ($this->persona) {
            $this->ordenes = Orden::where('cliente_id', $this->persona->id)->get();
        }
    }
    public function render()
    {
        return view('livewire.customer.orden-lista');
    }
}
