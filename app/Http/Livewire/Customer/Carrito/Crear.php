<?php

namespace App\Http\Livewire\Customer\Carrito;

use Livewire\Component;

class Crear extends Component
{
    public function mount()
    {
        $this->carrito = Carrito::where('')
    }
    public function render()
    {
        return view('livewire.customer.carrito.crear');
    }
}
