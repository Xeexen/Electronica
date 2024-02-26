<?php

namespace App\Http\Livewire\Components;

use App\Models\Product;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;

class Spotlight extends Component
{
    public bool $searchFromAdmin = false;

    public string $query = '';

    public $categorias, $subcategorias;

    public function mount()
    {
        $this->searchFromAdmin = request()->routeIs('employee.*');
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getProductsProperty()
    {
        $products = [];

        if ($this->query) {
            $products = Producto::query()
                ->select('id', 'nombre', 'precio', 'categoria', 'subcategoria')
                ->where('nombre', 'like', "%{$this->query}%");

            $this->categorias = Categoria::whereIn('id', $products->pluck('categoria'))->get();

            $this->subcategorias = Subcategoria::whereIn('id', $products->pluck('subcategoria'))->get();

            $products = $products->get();
        }

        return $products;
    }

    public function render()
    {
        return view('livewire.components.spotlight', [
            'products' => $this->products,
        ]);
    }
}
