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
                Editar Producto
            </h1>
            {{-- <x-badge :type="$product->is_active ? 'success' : 'default'">
                {{ $product->status->label() }}
            </x-badge> --}}
        </div>
        {{-- <div class="flex mt-4 sm:mt-0 sm:ml-4">
            <a href="{{ route('guest.products.detail', $product) }}" target="_blank"
                class="w-full btn btn-outline-primary">
                {{ __('Preview') }}
            </a>
        </div> --}}
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
                                        <x-input-label for="name" :value="__('Name')" />

                                        <x-input wire:model.lazy="nombre" type="text" id="name"
                                            class="block w-full mt-1 sm:text-sm"
                                            :placeholder="__('Enter product name')" />

                                        <x-input-error for="nombre" class="mt-2" />
                                    </div>

                                    {{-- Price --}}
                                    <div>
                                        <x-input-label for="price" :value="__('Price')" />

                                        <x-input-money type="text" id="price" wire.model.lazy="precio"
                                            placeholder="0.00" class="block w-full sm:text-sm" wrapper-classes="mt-1" />

                                        <x-input-error for="precio" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="excerpt" :value="__('Excerpt')" />

                                        <x-textarea wire:model.defer="impuesto" id="excerpt"
                                            class="block w-full mt-1 sm:text-sm" rows="3"
                                            :placeholder="__('Enter product excerpt')" />

                                        <x-input-error for="impuesto" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="categoria" :value="__('Categoria')" />

                                        <x-select wire:model.defer="categoria" id="categoria"
                                            class="block w-full mt-1 sm:text-sm">
                                            <option value="">{{ __('Selecione la Categoria') }}</option>
                                            <option value="">Coito</option>
                                        </x-select>

                                        <x-input-error for="subcategoria" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="subcategoria" :value="__('Subcategoria')" />

                                        <x-select wire:model.defer="subcategoria" id="subcategoria"
                                            class="block w-full mt-1 sm:text-sm">
                                            <option value="">{{ __('Selecione la Subcategoria') }}</option>
                                            <option value="">Coito</option>
                                        </x-select>

                                        <x-input-error for="categoria" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="imagen" :value="__('Subir Imagen')" />
                                        <x-input
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium bg-white border rounded-l-md border-slate-300 text-slate-700 hover:bg-slate-50 focus:z-10 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:focus:ring-sky-400 dark:focus:border-sky-400 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800"
                                            wire:model="imagen" type="file" />
                                    </div>
                                    {{-- Description --}}
                                    <div>
                                        <x-standalone-label :value="__('Description')" />

                                        <div
                                            class="px-4 mt-1 border rounded-md shadow-sm border-slate-300 dark:border-white/10 dark:bg-white/5">
                                            <x-tiptap wire:target="save" wire:loading.delay.class="opacity-50"
                                                wire:model.defer="descripcion" />
                                        </div>

                                        <x-input-error for="descripcion" class="mt-2" />
                                    </div>
                                </fieldset>
                            </x-slot:content>
                            <x-slot:footer class="bg-slate-50 dark:bg-slate-800/75">
                                <div class="flex items-center justify-end">
                                    <button wire:target="save" wire:loading.delay.attr="disabled" type="submit"
                                        class="btn btn-primary">
                                        {{ __('Guardar Cambios') }}
                                    </button>
                                </div>
                            </x-slot:footer>
                        </x-card>
                    </form>

                    <div x-data="{ addFromURL: false, selectedImage: null }"
                        x-on:upload-image-success.window="addFromURL = false; selectedImage = $event.detail.imageId;">
                        <x-modal-dialog wire:model.defer="showImageModal">
                            <x-slot:title>
                                {{ __('Media') }}
                            </x-slot:title>
                            <x-slot:content>
                                <div x-show="!addFromURL" x-transition:enter.duration.150ms
                                    x-transition:leave.duration.50ms>
                                    <div class="inline-flex rounded-md">

                                        <div class="relative block -ml-px">
                                            <x-dropdown align="left">
                                                <x-slot:trigger>
                                                    <button type="button"
                                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium bg-white border rounded-r-md border-slate-300 text-slate-500 hover:bg-slate-50 focus:z-10 focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:focus:ring-sky-400 dark:focus:border-sky-400 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800">
                                                        <span class="sr-only">
                                                            {{ __('Open options') }}
                                                        </span>
                                                        <x-heroicon-m-chevron-down class="w-5 h-5" />
                                                    </button>
                                                </x-slot:trigger>
                                                <x-slot:content>
                                                    <x-dropdown-link x-on:click="addFromURL = !addFromURL"
                                                        role="button">
                                                        {{ __('Add from URL') }}
                                                    </x-dropdown-link>
                                                </x-slot:content>
                                            </x-dropdown>
                                        </div>
                                        <button x-show="selectedImage"
                                            x-on:click.prevent="if(confirm('{{ __('Are you sure you want to delete this image?') }}')) $wire.deleteImage(selectedImage); selectedImage = null;"
                                            type="button" class="ml-4 btn btn-outline-danger">
                                            <x-heroicon-m-trash class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                                <div x-show="addFromURL" x-transition:enter.duration.150ms
                                    x-transition:leave.duration.50ms>
                                    <form wire:submit.prevent="uploadImageFromURL">
                                        <fieldset wire:loading.attr="disabled">
                                            <x-input-label for="imageUrl" class="sr-only">
                                                {{ __('Image URL') }}
                                            </x-input-label>
                                            <div class="flex items-center">
                                                <div class="flex flex-1 rounded-md">
                                                    <div
                                                        class="relative flex items-stretch flex-grow focus-within:z-10">
                                                        <x-input wire:model.defer="imageUrl" type="text" id="imageUrl"
                                                            class="block w-full !rounded-r-none sm:text-sm"
                                                            placeholder="https://" />
                                                    </div>
                                                    <button type="submit" class="btn btn-primary !rounded-l-none">
                                                        <x-heroicon-m-arrow-up-tray
                                                            class="w-5 h-5 mr-2 -ml-1 text-white dark:text-slate-200" />
                                                        <span>{{ __('Upload') }}</span>
                                                    </button>
                                                </div>
                                                <button x-on:click="addFromURL = false" type="button"
                                                    class="inline-flex items-center py-2 ml-3">
                                                    <x-heroicon-m-x-mark class="w-5 h-5" />
                                                </button>
                                            </div>
                                            <x-input-error for="imageUrl" class="mt-2" />
                                        </fieldset>
                                    </form>
                                </div>
                                <ul
                                    class="grid grid-cols-2 mt-8 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                                    <li wire:target="image, imageUrl" wire:loading class="relative">
                                        <div
                                            class="block w-full overflow-hidden rounded-lg aspect-w-10 aspect-h-7 bg-slate-100 dark:bg-slate-700">
                                            <x-loading-spinner class="absolute inset-0 w-5 h-5 m-auto" />
                                        </div>
                                    </li>
                                </ul>
                            </x-slot:content>
                            <x-slot:footer>
                                <button x-bind:disabled="!selectedImage"
                                    x-on:click="$wire.insertImage(selectedImage); selectedImage = null" type="button"
                                    class="w-full btn btn-primary sm:ml-3 sm:w-auto">
                                    {{ __('Insert') }}
                                </button>
                                <button x-on:click="$wire.set('showImageModal', false)" type="button"
                                    class="w-full mt-3 btn btn-invisible sm:mt-0 sm:w-auto">
                                    {{ __('Cancel') }}
                                </button>
                            </x-slot:footer>
                        </x-modal-dialog>
                    </div>
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