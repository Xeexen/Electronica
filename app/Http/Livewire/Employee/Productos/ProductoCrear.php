<?php

namespace App\Http\Livewire\Employee\Productos;

use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class ProductoCrear extends Component
{
    public $nombre, $descripcion, $codigo, $categoria, $subcategoria, $precio, $impuesto;
    public $categorias, $subcategorias;

    public $rules = [
        'nombre' => 'required|max:20',
        'codigo' => 'required|max:20',
        'imagen' => 'nullable',
        'descripcion' => 'nullable|max:50',
        'categoria' => 'required',
        'precio' => 'required|max:8',
        'impuesto' => 'required',
    ];

    public function mount()
    {
       
    }

    public function save()
    {
        $this->validate();
        Producto::create([
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'subcategoria' => $this->subcategoria,
            'precio' => $this->precio,
            'impuesto' => $this->impuesto
        ]);
    }

    public function render()
    {
        return view('livewire.employee.productos.producto-crear')->layout('layouts.admin');
    }
}
