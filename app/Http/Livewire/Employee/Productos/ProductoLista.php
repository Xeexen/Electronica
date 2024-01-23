<?php

namespace App\Http\Livewire\Employee\Productos;

use Livewire\Component;
use App\Models\Producto;

class ProductoLista extends Component
{
    public $productos;

    public function mount()
    {
        $this->productos = Producto::all();
    }

    public function render()
    {
        return view('livewire.employee.productos.producto-lista')->layout('layouts.admin');
    }
}
