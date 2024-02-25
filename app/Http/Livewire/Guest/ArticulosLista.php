<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ArticulosLista extends Component
{
    public $sortBy = '';
    public $sortDirection = 'asc';
    public $perPage = 24;
    public $productos, $subcategoria, $categoria;

    public function mount($id)
    {
        $this->subcategoria = Subcategoria::find($id);
        $this->categoria = Categoria::firstWhere('id', $this->subcategoria->categoria_id);
        $this->productos = Producto::where('categoria', $id)->get();
    }

    public function applySorting($sortBy, $sortDirection)
    {
        $this->sortBy = $sortBy;

        $this->sortDirection = $sortDirection;
    }

    public function render()
    {
        return view('livewire.guest.articulos-lista');
    }
}
