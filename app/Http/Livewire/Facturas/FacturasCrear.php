<?php

namespace App\Http\Livewire\Facturas;

use App\Models\Persona;
use Livewire\Component;
use App\Models\Producto;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FacturasCrear extends Component
{
    use LivewireAlert;

    public $productos, $clientes, $items;
    public $nombre, $precio, $cantidad, $descuento, $iva, $subtotal, $descuentoTotal, $subtotal_12, $ivaTotal, $subtotal_0, $subtotales, $total;

    public function mount()
    {
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

    public function render()
    {
        return view('livewire.facturas.facturas-crear')->layout('layouts.admin');
    }
}
