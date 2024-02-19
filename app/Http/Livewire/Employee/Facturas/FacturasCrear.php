<?php

namespace App\Http\Livewire\Employee\Facturas;

use App\Models\Empresa;
use App\Models\Factura;
use App\Models\Persona;
use Livewire\Component;
use App\Models\Producto;
use App\Models\FacturaDetalle;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacturasCrear extends Component
{
    use LivewireAlert;

    public Factura $factura;
    public $productos, $clientes, $items, $empresa;
    public $nombre, $precio, $cantidad, $descuento, $iva, $subtotal, $descuentoTotal, $subtotal_12, $ivaTotal, $subtotal_0, $subtotales, $total;

    public function rules()
    {
        return [
            'factura.establecimiento' => 'required|max:3',
            'factura.puntoEmision' => 'required|max:3',
            'factura.cliente_id' => 'required'
        ];
    }
    public function mount()
    {
        $this->factura = new Factura();
        $this->items[] = [
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'descuento' => $this->descuento,
            'iva' => $this->iva,
            'subtotal' => $this->subtotal,
        ];
        $this->productos = Producto::all();
        $this->clientes = Persona::where('tipoPersona->cliente', true)->get();
        $this->empresa = Empresa::first();
    }

    public function valores($index)
    {
        if ($this->items[$index]['nombre']  != null) {
            $this->items[$index]['iva'] = $this->productos->where('id', $this->items[$index]['nombre'])->first()->impuesto;
            $this->items[$index]['precio'] = $this->productos->where('id', $this->items[$index]['nombre'])->first()->precio;
        } else {
            $this->items[$index]['iva'] = 0;
            $this->items[$index]['precio'] = 'No se encuentra productos';
        }
        $this->calc($index);
    }

    public function calc($index)
    {
        $subtotal = ((float)$this->items[$index]['cantidad'] * (float)$this->items[$index]['precio'] - (float)$this->items[$index]['descuento']);

        $this->items[$index]['subtotal'] = number_format($subtotal, 2, '.', '');
        $this->calcSubtotal();
    }

    public function calcSubtotal()
    {
        (float)$this->descuentoTotal = 0;
        (float)$this->subtotal_12 = 0;
        (float)$this->subtotal_0 = 0;
        (float)$this->ivaTotal = 0;
        (float)$this->subtotal_0 = 0;
        foreach ($this->items as $producto) {
            if ($producto['iva'] === "0.12") {
                (float)$this->subtotal_12  += (float)$producto['subtotal'];
            }
        }
        foreach ($this->items as $producto0) {
            if ($producto0['iva'] != "0.12") {
                $this->subtotal_0 += (float)$producto0['subtotal'];
            }
        }
        foreach ($this->items as $descuento) {
            (float)$this->descuentoTotal += (float)$descuento['descuento'];
        }

        $this->subtotales = $this->subtotal_12 + $this->subtotal_0;
        $this->ivaTotal = (float)$this->subtotal_12 * 0.12;
        $this->total = (float)$this->subtotal_0 + (float)$this->subtotal_12 + (float)$this->ivaTotal;

        $this->subtotales = number_format($this->subtotales, 2);
        $this->ivaTotal = number_format($this->ivaTotal, 2);
        $this->total = number_format($this->total, 2);
    }

    public function agregarFila()
    {
        $this->items[] = [
            'nombre' => $this->nombre,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'descuento' => $this->descuento,
            'iva' => $this->iva,
            'subtotal' => $this->subtotal,
        ];
    }

    public function eliminarFila($index)
    {
        $nuevasFilas = [];
        foreach ($this->items as $key => $fila) {
            if ($key !== $index) {
                $nuevasFilas[] = $fila;
            }
        }
        $this->items = $nuevasFilas;
        $this->calcSubtotal();
    }

    public function save()
    {
        $this->validate();

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

        $this->factura->descuento = $this->descuentoTotal;

        $this->factura->save();

        foreach ($this->items as $detalle) {
            FacturaDetalle::create([
                'producto_id' => $detalle['nombre'],
                'precio' => $detalle['precio'],
                'cantidad' => $detalle['cantidad'],
                'descuento' => $detalle['descuento'],
                'subtotal' => $detalle['subtotal'],
                'factura_id' => $this->factura->id
            ]);
        }

        $this->flash('success', 'Se creo el comprobante No. ' . $this->factura->establecimiento . '-' . $this->factura->puntoEmision . '-' . $this->factura->secuencial, [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        return redirect()->to(route('employee.facturas.lista'));
    }

    public function render()
    {
        return view('livewire.facturas.facturas-crear')->layout('layouts.admin');
    }
}
