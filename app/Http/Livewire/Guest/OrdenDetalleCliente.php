<?php

namespace App\Http\Livewire\Guest;

use App\Models\Orden;
use App\Models\Ciudad;
use App\Models\Carrito;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Provincia;
use Illuminate\Support\Str;
use App\Models\Subcategoria;
use App\Models\FacturaDetalle;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OrdenDetalleCliente extends Component
{
    use LivewireAlert;

    public Orden $orden;

    public Persona $persona;

    public Factura $factura;

    public $carrito, $productos, $subtotal, $categorias, $subcategorias, $provincias, $ciudades, $listaCiudades;

    public $retiro = false, $envio = false;

    public $provincia, $numero, $cvv, $fecha, $ciudad, $impuesto, $total, $empresa;

    public function rules()
    {
        return [
            'persona.nombre' => 'required',
            'persona.documento' => 'required',
            'persona.email' => 'required',
            'persona.telefono' => 'required',
            'persona.direccion' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
            'fecha' => 'required',
            'cvv' => 'required',
            'numero' => 'required',
        ];
    }

    public function mount()
    {
        $this->empresa = Empresa::first();

        $this->carrito = Carrito::where('sesion', session()->getId())->get();

        $this->productos = Producto::whereIn('id', $this->carrito->pluck('producto_id'))->get();

        $this->categorias = Categoria::whereIn('id', $this->productos->pluck('categoria'))->get();

        $this->subcategorias = Subcategoria::whereIn('id', $this->productos->pluck('subcategoria'))->get();

        $this->provincias = Provincia::all();

        $this->ciudades = Ciudad::all();

        $personas = Persona::all();

        $personaEncontrada = false;

        foreach ($personas as $persona) {
            if (Auth::user()->id === (int)$persona->usuario_id) {
                $this->persona = $persona;
                $personaEncontrada = true;
            }
        }

        if (!$personaEncontrada) {
            $this->persona = new Persona();
        }

        foreach ($this->carrito as $carro) {
            foreach ($this->productos as $producto) {
                if ($carro->producto_id === $producto->id) {
                    $subtotal = $carro->cantidad * $producto->precio;
                    $this->subtotal += $subtotal;
                }
            }
        }

        $this->impuesto =  $impuesto = $subtotal * 0.12;

        $this->total = $this->subtotal + $this->impuesto;

        $this->orden = new Orden();

        $this->factura = new Factura();
    }

    public function updatedRetiro($value)
    {
        if ($value == true) {
            $this->envio = false;
        }
    }

    public function updatedEnvio($value)
    {
        if ($value == true) {
            $this->retiro = false;
        }
    }

    public function updatedProvincia()
    {
        $this->listaCiudades = $this->ciudades->where('provincia_id', $this->provincia);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'numero' => $this->numero,
            'cvv' => $this->cvv,
            'fecha' => $this->fecha,
        ];

        if (Str::length($this->persona->documento) === 10) {
            $this->persona->tipoDocumento = 'cedula';
        } else {
            $this->persona->tipoDocumento = 'ruc';
        }

        $ultimaOrden = Orden::orderBy('numero', 'desc')->first();

        $numero = $ultimaOrden ? $ultimaOrden->numero + 1 : 1;

        $this->orden->numero = str_pad($numero, 9, "0", STR_PAD_LEFT);

        $this->orden->formaPago = json_encode($data);
        $tipoPersona = [
            'cliente' => true,
            'proveedor' => false
        ];
        $this->persona->tipoPersona = json_encode($tipoPersona);

        $this->persona->usuario_id = Auth::user()->id;

        $this->persona->provincia = $this->provincia;

        $this->persona->ciudad = $this->ciudad;

        $this->persona->save();

        $this->orden->cliente_id = $this->persona->id;

        $this->orden->cancelado = false;

        $this->orden->enviado = false;

        $this->orden->recibido = true;

        $this->orden->total = $this->total;

        $this->orden->save();

        $this->factura->establecimiento = 010;

        $this->factura->puntoEmision = 010;

        $ultimaFactura = Factura::where('establecimiento', $this->factura->establecimiento)
            ->where('puntoEmision', $this->factura->puntoEmision)
            ->orderBy('secuencial', 'desc')
            ->first();
        $numeroFactura = $ultimaFactura ? $ultimaFactura->secuencial + 1 : 1;
        $this->factura->secuencial = str_pad($numeroFactura, 9, "0", STR_PAD_LEFT);
        $claveAcceso = str_replace('-', '', \Carbon\Carbon::now()->format('d-m-Y')) . '01' . $this->empresa->ruc . '2' . $this->factura->establecimiento . $this->factura->puntoEmision . $this->factura->secuencial . "12345678" . "1";

        $clave = strrev($claveAcceso);
        $suma = 0;
        $factor = 2;

        for ($i = 0; $i < strlen($clave); $i++) {
            $suma += $clave[$i] * $factor;
            $factor = $factor == 7 ? 2 : $factor + 1;
        }

        $modulo = $suma % 11;

        if ($modulo >= 2) {
            $modulo = 11 - $modulo;
        } else {
            $modulo = 0;
        }

        if ($modulo === 10) {
            $modulo = 0;
        }

        $this->factura->codigoAcceso = $claveAcceso . $modulo;

        $this->factura->total = $this->total;

        $this->factura->descuento = 0.00;

        $this->factura->cliente_id = $this->persona->id;

        $this->factura->subtotal = $this->subtotal;

        $this->factura->save();

        foreach ($this->carrito as $detalle) {
            foreach ($this->productos as $producto) {
                if ($detalle->producto_id === $producto->id) {
                    $subtotal = $detalle->cantidad * $producto->precio;
                    FacturaDetalle::create([
                        'producto_id' => $producto['id'],
                        'precio' => $producto['precio'],
                        'cantidad' => $detalle['cantidad'],
                        'descuento' => '0',
                        'subtotal' =>  $subtotal,
                        'factura_id' => $this->factura->id
                    ]);
                }
            }
        }

        $this->flash('success', 'Se creo tu orden No.' . $this->orden->numero, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        foreach ($this->carrito as $carrito) {
            $carrito->delete();
        }
    }

    public function render()
    {
        return view('livewire.guest.orden-detalle-cliente');
    }
}
