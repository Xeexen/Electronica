<?php

namespace App\Http\Livewire\Employee\Personas;

use App\Models\Persona;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PersonaCrear extends Component
{
    public Persona $persona;
    public $provincias, $provincia, $ciudad;
    public $cliente, $proveedor;

    public function rules()
    {
        return [
            'persona.nombre' => 'required',
            'persona.documento' => 'required|min:10|max:13',
        ];
    }

    public function mount()
    {
        $this->persona = new Persona;
        $this->provincias = DB::table('provincias')->get();
        // dd($this->persona);
    }

    public function save()
    {
        $tipoPersona = [
            'cliente' => $this->cliente,
            'proveedor' => $this->proveedor
        ];

        if (Str::length($this->persona->documento) === 10) {
            $this->persona->tipoDocumento = 'cedula';
        }else{
            $this->persona->tipoDocumento = 'ruc';
        }

        $this->persona->tipoPersona = json_encode($tipoPersona);

        $this->persona->save();
    }

    public function render()
    {
        return view('livewire.employee.personas.persona-crear')->layout('layouts.admin');
    }
}
