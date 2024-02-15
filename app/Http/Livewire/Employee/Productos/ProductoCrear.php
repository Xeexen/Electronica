<?php

namespace App\Http\Livewire\Employee\Productos;

use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductoCrear extends Component
{
    use WithFileUploads, LivewireAlert;
    public Producto $producto;
    public $categorias, $subcategorias, $imagen;

    public $rules = [
        'producto.nombre' => 'required|max:20',
        'producto.codigo' => 'required|max:20',
        'imagen' => 'nullable|mimes:jpg, png, webp, jpeg',
        'producto.descripcion' => 'nullable|max:50',
        'producto.categoria' => 'required',
        'producto.subcategoria' => 'required',
        'producto.precio' => 'required|max:8',
        'producto.impuesto' => 'required',
    ];

    public function mount()
    {
        $this->producto = new Producto;
    }

    public function save()
    {

        $this->validate();

        if ($this->imagen) {

            // dd($this->imagen);
            $customFileName = Str::slug($this->producto->codigo) . '.webp';
            $this->imagen->storeAs('public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria, $customFileName);

            $webpImage = Image::make(storage_path('app/public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName));
            $webpImage->encode('webp', 90)->save();

            $path = 'storage/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName;
        } else {
            $path = null;
        }

        $this->producto->imagen = $path;

        $this->producto->unidades = 0;
        
        $this->producto->save();

        $this->flash('success', 'Se creo el producto ' . $this->producto->nombre, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        return redirect()->to(route('productos'));
    }

    public function render()
    {
        return view('livewire.employee.productos.producto-crear')->layout('layouts.admin');
    }
}
