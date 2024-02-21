<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Nuevo Producto') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex items-center flex-1 min-w-0 space-x-2">
            <a href="{{ route('employee.productos') }}" class="btn btn-default btn-xs">
                <x-heroicon-m-arrow-left class="w-5 h-5" />
            </a>
            <h1 class="text-2xl font-medium truncate text-slate-900 dark:text-slate-100">
                Nuevo Producto
            </h1>

        </div>

    </div>

    <!-- Page content -->
    <div class="p-4 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 space-y-6 xl:col-span-2">
                <div>
                    <form wire:submit.prevent="save">
                        <x-card class="relative overflow-hidden">
                            <x-slot:content>
                                <fieldset wire:target="save" wire:loading.delay.attr="disabled"
                                    class="grid grid-cols-1 gap-6">
                                    {{-- Name --}}
                                    <div>
                                        <x-input-label for="nombre" :value="__('Nombre')" />

                                        <x-input wire:model.defer="producto.nombre" type="text" id="nombre"
                                            class="block w-full mt-1 sm:text-sm"
                                            :placeholder="__('Ingresa el nombre')" />

                                        <x-input-error for="producto.nombre" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="codigo" :value="__('Codigo')" />

                                        <x-input wire:model.defer="producto.codigo" type="text" id="codigo"
                                            class="block w-full mt-1 sm:text-sm"
                                            :placeholder="__('Ingresa el codigo')" />

                                        <x-input-error for="producto.codigo" class="mt-2" />
                                    </div>

                                    {{-- Price --}}
                                    <div>
                                        <x-input-label for="precio" :value="__('Precio')" />

                                        <x-input-money type="text" id="precio" wire:model.defer="producto.precio"
                                            placeholder="0.00" class="block w-full sm:text-sm" wrapper-classes="mt-1" />

                                        <x-input-error for="producto.precio" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="impuesto" :value="__('Impuesto')" />

                                        <x-select id="impuesto" wire:model.defer="producto.impuesto"
                                            class="block w-full mt-1 sm:text-sm" rows="3"
                                            :placeholder="__('Enter product excerpt')">
                                            <option value="">{{ __('Seleccione') }}</option>
                                            <option value="0.12">{{ __('12%') }}</option>
                                            <option value="0.00">{{ __('0%') }}</option>
                                        </x-select>
                                        <x-input-error for="producto.impuesto" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="categoria" :value="__('Categoria')" />

                                        <x-select wire:model="producto.categoria" wire:change='listaSubcategoria'
                                            id="categoria" class="block w-full mt-1 sm:text-sm">
                                            <option value="">{{ __('Selecione la Categoria') }}</option>
                                            @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                            @endforeach
                                        </x-select>

                                        <x-input-error for="producto.categoria" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="subcategoria" :value="__('Subcategoria')" />

                                        <x-select wire:model.defer="producto.subcategoria" id="subcategoria"
                                            class="block w-full mt-1 sm:text-sm">
                                            <option value="">{{ __('Selecione la Subcategoria') }}</option>
                                            @if ($subcategoriasLista)
                                            @foreach ($subcategoriasLista as $subcategoria)
                                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->subcategoria }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </x-select>

                                        <x-input-error for="producto.subcategoria" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="imagen" :value="__('Subir Imagen')" />
                                        <x-input
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white border rounded-l-md border-slate-300 text-slate-700 hover:bg-slate-50 focus:z-10 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:focus:ring-sky-400 dark:focus:border-sky-400 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800"
                                            wire:model="imagen" type="file" />
                                        <x-input-error for="imagen" class="mt-2" />
                                    </div>
                                    {{-- Description --}}
                                    <div>
                                        <x-standalone-label :value="__('Description')" />

                                        <div
                                            class="px-4 mt-1 border rounded-md shadow-sm border-slate-300 dark:border-white/10 dark:bg-white/5">
                                            <x-tiptap wire:loading.delay.class="opacity-50"
                                                wire:model.defer="producto.descripcion" />
                                        </div>

                                        <x-input-error for="producto.descripcion" class="mt-2" />
                                    </div>
                                </fieldset>
                            </x-slot:content>
                            <x-slot:footer class="bg-slate-50 dark:bg-slate-800/75">
                                <div class="flex items-center justify-end">
                                    <button wire:target="save" wire:loading.delay.attr="disabled" type="submit"
                                        class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </x-slot:footer>
                        </x-card>
                    </form>
                </div>

                {{--
                <livewire:employee.product.components.product-specification :product="$product" />

                <livewire:employee.product.components.product-gallery :product="$product" />

                @unless($product_options_count)
                <livewire:employee.product.components.product-variant-pricing :product="$product"
                    :variant="$product->variants->first()" />

                <livewire:employee.product.components.product-variant-inventory :product="$product"
                    :variant="$product->variants->first()" />

                <livewire:employee.product.components.product-variant-shipping :product="$product"
                    :variant="$product->variants->first()" />
                @endunless

                <livewire:employee.product.components.product-option :product="$product" />

                @if($product_options_count > 0)
                <livewire:employee.product.components.product-variant-list :product="$product" />
                @endif

                <livewire:employee.search-engine-information-form :model="$product" />--}}
            </div>

            {{-- <div class="col-span-3 space-y-6 xl:col-span-1">
                <livewire:employee.product.components.product-status :product="$product" />

                <livewire:employee.product.components.product-organization :product="$product" />
            </div> --}}
        </div>
    </div>
</div>