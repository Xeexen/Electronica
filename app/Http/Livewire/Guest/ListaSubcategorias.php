<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ListaSubcategorias extends Component
{
    public $perPage = 12;
    public $subcategorias, $categoria;

    public function mount($id)
    {
        $this->categoria = Categoria::find($id);
        $this->subcategorias = Subcategoria::where('categoria_id', $id)->get();
    }

    public function getRowsQueryProperty()
    {
        return Subcategoria::query();
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.guest.lista-subcategorias', [
            'collections' => $this->rows,
        ])->layout('layouts.guest');
    }
}
