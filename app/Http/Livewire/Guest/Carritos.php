<?php

namespace App\Http\Livewire\Guest;

use App\Models\Carrito;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Carritos extends Component
{
    public $carrito, $categoria, $subcategoria;

    public function mount()
    {
        
        $this->carrito = Carrito::where('sesion', session()->getId())->get();

        $this->categoria = Categoria::all();

        $this->subcategoria = Subcategoria::all();

    }

    public function render()
    {
        return view('livewire.guest.carritos');
    }
}
