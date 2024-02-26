<?php

namespace App\Http\Livewire\Guest;

use App\Models\Carrito;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Carritos extends Component
{
    public $carrito, $categorias, $subcategorias, $productos, $total;

    public function mount()
    {
        $this->carrito = Carrito::where('sesion', session()->getId())->get();

        $this->productos = Producto::whereIn('id', $this->carrito->pluck('producto_id'))->get();

        $this->categorias = Categoria::whereIn('id', $this->productos->pluck('categoria'))->get();

        $this->subcategorias = Subcategoria::whereIn('id', $this->productos->pluck('subcategoria'))->get();

        // dd($this->categorias);
        $this->total = 0;

        foreach ($this->carrito as $carro) {
            foreach ($this->productos as $producto) {
                if ($carro->producto_id === $producto->id) {
                    $subtotal = $carro->cantidad * $producto->precio;
                    $this->total += $subtotal;
                }
            }
        }
    }

    public function borrar($id){
        Carrito::find($id)->delete();
        $this->mount();

    }

    public function render()
    {
        return view('livewire.guest.carritos');
    }
}
