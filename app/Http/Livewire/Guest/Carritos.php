<?php

namespace App\Http\Livewire\Guest;

use App\Models\Carrito;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Carritos extends Component
{
    public $carrito, $categorias, $subcategoria, $productos, $total;

    public function mount()
    {
        $this->carrito = Carrito::where('sesion', session()->getId())->get();

        $this->productos = Producto::whereIn('id', $this->carrito->pluck('producto_id'))->get();

        $this->categorias = Categoria::all();

        $this->subcategoria = Subcategoria::all();

        $this->total = 0;
        
        foreach ($this->carrito as $carro){
            foreach($this->productos as $producto){
                if($carro->producto_id === $producto->id)
                $this->total = $carro->cantidad * $producto->precio;
            }
        }
    }

    

    public function render()
    {
        return view('livewire.guest.carritos');
    }
}