<?php

namespace App\Http\Livewire\Employee\Productos;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Models\Subcategoria;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductoCrear extends Component
{
    use WithFileUploads, LivewireAlert;
    public Producto $producto;
    public $categorias, $subcategorias, $imagen, $subcategoriasLista;

    public $rules = [
        'producto.nombre' => 'required|max:20',
        'producto.codigo' => 'required|max:20',
        'imagen' => 'nullable|mimes:jpg, png, webp, jpeg',
        'producto.descripcion' => 'required|max:50',
        'producto.categoria' => 'required',
        'producto.subcategoria' => 'required',
        'producto.precio' => 'required|max:8',
    ];

    public function mount()
    {
        $this->producto = new Producto;
        $this->categorias = Categoria::all();
        $this->subcategorias = Subcategoria::all();
    }

    public function listaSubcategoria()
    {
        $this->subcategoriasLista = $this->subcategorias->where('categoria_id', $this->producto->categoria);
    }

    public function save()
    {

        $this->validate();

        if ($this->imagen) {

            $customFileName = Str::slug($this->producto->codigo) . '.webp';
            $this->imagen->storeAs('public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria, $customFileName);

            $webpImage = Image::make(storage_path('app/public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName));
            $webpImage->encode('webp', 90)->save();

            $path = 'storage/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName;
        } else {
            $path = null;
        }

        $this->producto->imagen = $path;

        $this->producto->impuesto = 0.12;

        $this->producto->unidades = 0;

        $this->producto->save();

        $this->flash('success', 'Se creo el producto ' . $this->producto->nombre, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        return redirect()->to(route('employee.productos'));
    }

    public function render()
    {
        return view('livewire.employee.productos.producto-crear')->layout('layouts.admin');
    }
}
