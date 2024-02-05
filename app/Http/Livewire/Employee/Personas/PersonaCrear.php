<?php

namespace App\Http\Livewire\Employee\Personas;

use App\Models\Ciudad;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Provincia;
use Illuminate\Support\Str;

class PersonaCrear extends Component
{
    public Persona $persona;
    public $provincias, $ciudades, $listaCiudades;
    public $cliente, $proveedor, $provincia;

    public function rules()
    {
        return [
            'persona.nombre' => 'required',
            'persona.documento' => 'required|min:10|max:13',
            'persona.direccion' => 'required',
            'persona.email' => 'required|email|unique:personas',
            'persona.telefono' => 'required|numeric',
            'persona.provincia' => 'required',
            'persona.ciudad' => 'required',
        ];
    }

    public function updatedProvincia()
    {
        $this->listaCiudades = $this->ciudades->where('provincia_id', $this->provincia);
    }

    public function mount()
    {
        $this->persona = new Persona;
        $this->provincias = Provincia::all();
        $this->ciudades = Ciudad::all();
    }

    public function save()
    {
        $tipoPersona = [
            'cliente' => $this->cliente,
            'proveedor' => $this->proveedor
        ];

        if (Str::length($this->persona->documento) === 10) {
            $this->persona->tipoDocumento = 'cedula';
        } else {
            $this->persona->tipoDocumento = 'ruc';
        }

        $this->persona->tipoPersona = json_encode($tipoPersona);

        $this->persona->provincia = $this->provincia;
        $this->persona->save();
        return redirect()->to(route('personas'));
    }

    public function render()
    {
        return view('livewire.employee.personas.persona-crear')->layout('layouts.admin');
    }
}
