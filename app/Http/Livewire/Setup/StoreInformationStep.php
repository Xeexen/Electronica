<?php

namespace App\Http\Livewire\Setup;

use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\Provincia;
use App\Settings\BrandSetting;
use App\Settings\GeneralSetting;
use Spatie\LivewireWizard\Components\StepComponent;

class StoreInformationStep extends StepComponent
{
    public Empresa $empresa;

    public $ciudades, $provincias, $ciudad, $provincia, $listaCiudades;

    public $state = [
        'store_name' => '',
        'store_slogan' => '',
        'store_contact_email' => '',
        'store_contact_phone' => '',
    ];

    protected function rules()
    {
        return [
            'state.store_name' => 'required|string',
            'state.store_slogan' => 'required|string',
            'state.store_contact_email' => 'required|email',
            'state.store_contact_phone' => 'required|string',
            'empresa.contribuyenteEspecial' => 'nullable|boolean',
            'empresa.numeroContribuyente' => 'nullable|numeric',
            'empresa.nombreComercial' => 'nullable|max:50',
            'empresa.direccion' => 'required|max:50',
            'empresa.ruc' => 'required|size:13',
            'provincia' => 'required',
            'ciudad' => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'state.store_name.required' => 'Store name is required.',
            'state.store_name.string' => 'Store name must be a string.',
            'state.store_slogan.string' => 'Store slogan must be a string.',
            'state.store_contact_email.email' => 'Store contact email must be a valid email address.',
            'state.store_contact_phone.string' => 'Store contact phone must be a string.',
        ];
    }

    public function mount()
    {
        $this->state['store_name'] = $this->general_settings->store_name;

        $this->state['store_slogan'] = $this->brand_settings->slogan;

        $this->state['store_contact_email'] = $this->general_settings->contact_email;

        $this->state['store_contact_phone'] = $this->general_settings->contact_phone;

        $this->empresa = new Empresa();

        $this->empresa->contribuyenteEspecial = false;

        $this->ciudades = Ciudad::all();

        $this->provincias = Provincia::all();
    }

    public function updatedProvincia()
    {
        $this->listaCiudades = $this->ciudades->where('provincia_id', $this->provincia);
    }

    public function save()
    {
        $this->validate();

        $this->empresa->razonSocial = $this->general_settings->store_name;

        $this->empresa->ciudad = $this->ciudad;

        $this->empresa->provincia = $this->provincia;

        $this->empresa->email = $this->general_settings->contact_email;

        $this->empresa->telefono = $this->general_settings->contact_phone;

        $this->empresa->save();

        $this->nextStep();
    }

    public function getGeneralSettingsProperty()
    {
        return app(GeneralSetting::class);
    }

    public function getBrandSettingsProperty()
    {
        return app(BrandSetting::class);
    }

    public function render()
    {
        return view('livewire.setup.store-information-step');
    }
}
