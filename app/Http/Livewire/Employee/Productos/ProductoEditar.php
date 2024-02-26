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

class ProductoEditar extends Component
{
    use WithFileUploads, LivewireAlert;

    public Producto $producto;

    public $categorias, $subcategorias, $imagen, $subcategoriasLista;

    public function rules()
    {
        return [
            'producto.nombre' => 'required|max:20',
            'producto.codigo' => 'required|max:20',
            'producto.descripcion' => 'required|max:250',
            'producto.categoria' => 'required',
            'producto.subcategoria' => 'required',
            'producto.precio' => 'required|max:8',
        ];
    }


    public function mount($id)
    {
        $this->producto = Producto::find($id);
        $this->imagen = $this->producto->imagen;
        $this->categorias = Categoria::all();
        $this->subcategorias = Subcategoria::all();
    }

    public function save()
    {

        $this->validate();
        if ($this->imagen && $this->imagen != $this->producto->imagen) {
            if ($this->imagen) {
                $customFileName = Str::slug($this->producto->codigo) . '.webp';
                $this->imagen->storeAs('public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria, $customFileName);

                $webpImage = Image::make(storage_path('app/public/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName));
                $webpImage->resize(25, 25, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $webpImage->encode('webp', 90)->save();

                $path = 'storage/productos/' . $this->producto->categoria . '/' . $this->producto->subcategoria . '/' . $customFileName;
                $this->producto->imagen = $path;
            }
        }

        $this->producto->impuesto = 0.12;

        $this->producto->unidades = 30;

        $this->producto->save();

        $this->flash('success', 'Se actualizo el producto: ' . $this->producto->nombre, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        return redirect()->to(route('employee.productos'));
    }

    public function render()
    {
        return view('livewire.employee.productos.producto-editar')->layout('layouts.admin');
    }
}
