<div>
    <!-- Meta title & description -->
    <x-slot:title>
        Nueva Factura
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="flex px-4 sm:px-6 lg:px-8">
        <div class="flex-shrink-0 mr-2">
            <a href="{{ route('employee.orders.list') }}" class="btn btn-default btn-xs">
                <x-heroicon-m-arrow-left class="w-5 h-5" />
            </a>
        </div>
        <div class="mt-0.5">
            <div class="sm:flex sm:items-center sm:space-x-3">
                <h1 class="text-2xl font-medium leading-none text-slate-900 dark:text-slate-100">
                    {{ __('Nueva Factura') }}
                </h1>
            </div>

            <div class="flex items-center mt-2 text-sm text-slate-500 dark:text-slate-400">
                <span>Creado</span>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <x-card>
                    <x-slot:header>
                        <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                            <div class="mt-2 ml-4">
                                <h2 class="">
                                    Informacion
                                </h2>
                            </div>
                        </div>
                    </x-slot:header>
                    <x-slot:content class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="establecimiento" :value="__('Establecimiento')" />
                                <x-input wire:model.defer="factura.establecimiento" type="text" id="name"
                                    class="block w-full mt-1 sm:text-sm" :placeholder="__('Ingresa el nombre')" />
                                <x-input-error for="nombre" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="puntoEmision" :value="__('Punto de Emision')" />
                                <x-input wire:model.defer="factura.puntoEmision" type="text" id="name"
                                    class="block w-full mt-1 sm:text-sm" :placeholder="__('Ingresa el nombre')" />
                                <x-input-error for="nombre" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="cliente" :value="__('Cliente:')" />
                                <x-select wire:model.defer="factura.cliente_id" id="subcategoria"
                                    class="block w-full mt-1 sm:text-sm">
                                    <option value="">{{ __('Selecione un Cliente') }}</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id}}">{{ $cliente->nombre}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                    </x-slot:content>

                </x-card>
            </div>
        </div>
        <div class="sm:col-span-2">
            <div class="flex-1 p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <x-card>
                    <x-slot:header class="grid grid-cols-1 gap-6">
                        <div class="items-center justify-between -mt-1 -ml-4 ">
                            <div class="mt-2 ml-4">
                                <h2 class="">
                                    Informacion del Cliente </h2>
                            </div>
                        </div>
                    </x-slot:header>
                    <x-slot:content class="grid grid-cols-1 gap-6">
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-input wire:model.defer="factura.puntoEmision" type="text" id="nombre"
                                class="block w-full mt-1 sm:text-sm" />
                        </div>
                        <div>
                            <x-input-label for="documento" :value="__('Documento')" />
                            <x-input type="text" id="documento" class="block w-full mt-1 sm:text-sm" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-input type="text" id="name" class="block w-full mt-1 sm:text-sm" />
                            <x-input-error for="nombre" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="telefono" :value="__('Telefono')" />
                            <x-input type="text" id="name" class="block w-full mt-1 sm:text-sm" />
                        </div>
                    </x-slot:content>
                </x-card>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 mt-6 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <div class="flex-1 p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="col-span-3 space-y-6 xl:col-span-2">
                    <x-card>
                        <x-slot:header>
                            <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                                <div class="mt-2 ml-4">
                                    <button wire:click.prevent='agregarFila' class="btn btn-primary">
                                        <x-heroicon-m-plus class="w-5 h-5 mr-2 -ml-1" />
                                        {{ __('Añadir Productos') }}
                                    </button>
                                </div>
                            </div>
                        </x-slot:header>
                        <x-slot:content class="-mx-4 -mt-5 sm:-mx-6">
                            <div class="-mb-5 space-y-6">
                                <div class="relative overflow-auto">
                                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                        <thead
                                            class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                            <tr>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('Nombre') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('Precio') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('IVA') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('QTY') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('Descuento') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('Subtotal') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3 text-xs font-medium tracking-wider text-center uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                    {{ __('Accion') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                            @foreach($items as $index => $item)
                                            <tr>
                                                <td class=" text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <x-select wire:model="items.{{ $index }}.nombre"
                                                                    wire:change.prevent='valores({{ $index }})'
                                                                    class="block sm:text-sm">
                                                                    <option value="">{{ __('Seleccione') }}</option>
                                                                    @foreach ($productos as $producto)
                                                                    <option value="{{ $producto->id }}">{{
                                                                        $producto->nombre}}</option>
                                                                    @endforeach
                                                                </x-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <x-input id="precio" class="block w-full mt-1"
                                                                    wire:change='calc({{ $index }})'
                                                                    wire:model="items.{{ $index }}.precio" type="precio"
                                                                    required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <label id="iva" class="block w-full mt-1">
                                                                    {{ $items[$index]['iva'] }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <x-input id="cantidad" class="block w-full mt-1"
                                                                    wire:change='calc({{ $index }})'
                                                                    wire:model="items.{{ $index }}.cantidad"
                                                                    type="cantidad" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <x-input id="descuento" class="block w-full mt-1"
                                                                    wire:change='calc({{ $index }})'
                                                                    wire:model="items.{{ $index }}.descuento"
                                                                    type="descuento" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <label id="precio" class="block w-full mt-1">
                                                                    {{ $items[$index]['subtotal'] }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-slate-500 dark:text-slate-400">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col max-w-xs ml-4">
                                                            <div
                                                                class="font-medium text-slate-900 hover:text-sky-600 truncate ... dark:text-slate-200 dark:hover:text-sky-400">
                                                                <button wire:click="eliminarFila({{$index}})"
                                                                    type="button" class="btn btn-outline-danger">
                                                                    <x-heroicon-m-trash class="w-5 h-5" />
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </x-slot:content>
                    </x-card>
                </div>
            </div>
        </div>
        <div class="sm:col-span-2">
            <div class="flex-1 p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-3">
                    <div class="col-span-3">
                        <x-card>
                            <x-slot:header>
                                <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                                    <div class="mt-2 ml-4">
                                        Info
                                    </div>
                                </div>
                            </x-slot:header>
                            <x-slot:content class="-mx-4 -mt-5 sm:-mx-6">
                                <div class="-mb-5 space-y-6">
                                    <div class="relative overflow-auto">
                                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                            <thead
                                                class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('Subtotal 12%') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $subtotal_12 ? $subtotal_12 : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('Subtotal 0%') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $subtotal_0 ? $subtotal_0 : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('Subtotal') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $subtotales ? $subtotales : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('IVA') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $ivaTotal ? $ivaTotal : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('Descuento') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $descuentoTotal ? $descuentoTotal : '' }}
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ __('Total') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-xs font-medium tracking-wider text-left uppercase sm:px-6 text-slate-500 dark:text-slate-400">
                                                        {{ $total ? $total : '' }}
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>
                                </div>
                            </x-slot:content>
                        </x-card>
                    </div>
                    <button wire:click.prevent='save' class="btn btn-primary">
                        <x-heroicon-m-plus class="w-5 h-5 mr-2 -ml-1" />
                        {{ __('Guardar') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>