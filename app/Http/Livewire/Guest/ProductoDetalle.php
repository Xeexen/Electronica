<?php

namespace App\Http\Livewire\Guest;

use App\Models\Carrito;
use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoDetalle extends Component
{
    public $producto;
    public Carrito $carrito;

    public function rules()
    {
        return [
            'carrito.cantidad' => 'required',
        ];
    }
    public function mount($id)
    {
        try {
            $this->producto = Producto::where('id', $id)->firstOrFail();
            $this->carrito = new Carrito();
        } catch (ModelNotFoundException) {
            return abort(404);
        }
    }

    public function añadirCarrito()
    {
        if (Auth::user()) {
            $this->carrito->cliente_id = Auth::user()->id;
        }
        $this->carrito->producto_id = $this->producto->id;

        $this->carrito->sesion = session()->getId();

        $this->carrito->save();
    }

    public function render()
    {
        return view('livewire.guest.producto-detalle');
    }
}
