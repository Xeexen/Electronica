<?php

namespace App\Http\Livewire\Guest;

use App\Models\Orden;
use App\Models\Carrito;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class OrdenDetalleCliente extends Component
{
    public Orden $orden;

    public $carrito, $productos, $subtotal, $categorias, $subcategoria;

    public function mount()
    {
        $this->carrito = Carrito::where('sesion', session()->getId())->get();

        $this->productos = Producto::whereIn('id', $this->carrito->pluck('producto_id'))->get();

        $this->categorias = Categoria::all();

        $this->subcategoria = Subcategoria::all();

        foreach ($this->carrito as $carro) {
            foreach ($this->productos as $producto) {
                if ($carro->producto_id === $producto->id)
                    $this->subtotal = $carro->cantidad * $producto->precio;
            }
        }

        $this->orden = new Orden();
    }

    public function render()
    {
        return view('livewire.guest.orden-detalle-cliente');
    }
}
