<?php

namespace App\Http\Livewire\Guest;

use App\Models\Categoria;
use Livewire\Component;

class ListaCategorias extends Component
{

    public $perPage = 12;
    public $categorias;

    public function mount()
    {
        $this->categorias = Categoria::all();
    }

    public function getRowsQueryProperty()
    {
        return Categoria::query();
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.guest.lista-categorias', [
            'collections' => $this->rows,
        ])->layout('layouts.guest');
    }
}
