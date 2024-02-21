<?php

namespace App\Http\Livewire\Customer\Carrito;

use App\Models\Carrito;
use Livewire\Component;

class Crear extends Component
{
    public $carrito;

    public function mount()
    {
        $this->carrito = Carrito::where('');
    }
    public function render()
    {
        return view('livewire.customer.carrito.crear');
    }
}
