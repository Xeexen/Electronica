<?php

namespace App\Http\Livewire\Productos;

use Livewire\Component;
use App\Models\Producto;

class ProductoShow extends Component
{
    public $productos;
    
    public function mount()
    {
        $this->productos = Producto::all();
    }


    public function render()
    {
        return view('livewire.productos.producto-show');
    }
}
