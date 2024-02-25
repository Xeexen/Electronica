<div x-data="{ showMobileFilter: false }">
    <div class="border-b border-slate-200">
        <nav aria-label="Breadcrumb" class="px-4 mx-auto overflow-hidden max-w-7xl whitespace-nowrap sm:px-6 lg:px-8">
            <ol role="list" class="flex items-center py-4 space-x-4">
                <li>
                    <div class="flex items-center">
                        <a href="/" class="mr-4 text-sm font-medium text-slate-900">
                            Home
                        </a>
                        <svg viewBox="0 0 6 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            class="w-auto h-5 text-slate-300">
                            <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                        </svg>
                    </div>
                </li>
                <li class="text-sm truncate">
                    <a href="{{ route('guest.subcategorias.lista', ['id' => $subcategoria->id , 'categoria' => $subcategoria->subcategoria]) }}"
                        aria-current="page" class="font-medium text-slate-500 hover:text-slate-600">
                        {{ $subcategoria->subcategoria }}
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <main class="max-w-2xl px-4 mx-auto lg:max-w-7xl lg:px-8">
        <div class="flex items-baseline justify-between pt-24 pb-6 border-b border-gray-200">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                {{ $subcategoria->subcategoria }}
            </h1>

            <div class="hidden lg:flex lg:items-center">
                <x-dropdown trigger-classes="ml-5">
                    <x-slot:trigger>
                        <button type="button"
                            class="inline-flex justify-center text-sm font-medium text-gray-700 group hover:text-gray-900"
                            id="menu-button" aria-expanded="false" aria-haspopup="true">
                            {{ __('Sort by') }}
                            @if($sortBy === 'precio' && $sortDirection === 'asc')
                            {{ __('Price: Low to High') }}
                            @elseif($sortBy === 'price' && $sortDirection === 'desc')
                            {{ __('Price: High to Low') }}
                            @elseif($sortBy === 'name' && $sortDirection === 'desc')
                            {{ __('Alphabetically, Z-A') }}
                            @else
                            {{ __('Alphabetically, A-Z') }}
                            @endif
                            <x-heroicon-m-chevron-down
                                class="flex-shrink-0 w-5 h-5 ml-1 -mr-1 text-gray-400 group-hover:text-gray-500" />
                        </button>
                    </x-slot:trigger>
                    <x-slot:content>
                        <x-dropdown-link role="button" wire:click="applySorting('name', 'asc')">
                            {{ __('Alphabetically, A-Z') }}
                        </x-dropdown-link>
                        <x-dropdown-link role="button" wire:click="applySorting('name', 'desc')">
                            {{ __('Alphabetically, Z-A') }}
                        </x-dropdown-link>
                        <x-dropdown-link role="button" wire:click="applySorting('price', 'asc')">
                            {{ __('Price: Low to High') }}
                        </x-dropdown-link>
                        <x-dropdown-link role="button" wire:click="applySorting('price', 'desc')">
                            {{ __('Price: High to Low') }}
                        </x-dropdown-link>
                    </x-slot:content>
                </x-dropdown>
            </div>
        </div>

        <div class="pt-12 pb-24 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
            @unless($productos->count())
            <div class="text-center lg:col-span-3 xl:col-span-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">
                    {{ __('Sin Productos') }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ __('No hay productos para esta subcategoria.') }}
                </p>
                <div class="mt-6">
                    <a href="{{ route('guest.products.list') }}" class="btn btn-primary">
                        <x-heroicon-m-arrow-left class="-ml-0.5 mr-1.5 h-5 w-5" />
                        {{ __('Volver a la Tienda') }}
                    </a>
                </div>
            </div>
            @else
            <section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
                <h2 id="product-heading" class="sr-only">
                    {{ __('Products') }}
                </h2>

                <div class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
                    @foreach($productos as $producto)
                    <div
                        class="relative flex flex-col overflow-hidden transition duration-150 bg-white border rounded-lg group border-slate-200 hover:border-sky-300 hover:shadow-lg hover:shadow-sky-300/50">
                        <div class="aspect-w-3 aspect-h-4 group-hover:opacity-75 sm:aspect-none">

                            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                                class="object-cover object-center w-full h-full sm:h-full sm:w-full">
                        </div>
                        <div class="flex flex-col items-center flex-1 p-4 space-y-2 text-center">
                            <h3 class="text-sm font-medium text-slate-900 line-clamp-2">
                                <a href="{{ route('guest.producto.detalle', ['id' => $producto->id, 'categoria' => $categoria->categoria, 'subcategoria' => $subcategoria->subcategoria, 'producto' => $producto->nombre]) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $producto->nombre }}
                                </a>
                            </h3>

                            <div class="flex flex-col justify-end flex-1 pt-1">
                                <p class="text-base font-medium text-slate-900">
                                    <x-money :amount="$producto->precio" :currency="config('app.currency')" />
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-10">
                </div>
            </section>
            @endunless
        </div>
    </main>

    <x-slide-over wire:model="showMobileFilterDialog">
        <x-slot:title>
            {{ __('Filters') }}
        </x-slot:title>
        <x-slot:content>
            <div class="space-y-10 divide-y divide-slate-200">
                {{--Price--}}
                <div wire:ignore x-data="
                        {
                            min: ,
                            max: ,
                            selectedMin: @entangle('filters.price.min').defer,
                            selectedMax: @entangle('filters.price.max').defer
                        }
                    " x-init="
                        slider = noUiSlider.create($refs.slider, {
                            start: [min, max],
                            step: 1,
                            format: {
                                to: function (value) {
                                    return value.toFixed(0);
                                },
                                from: function (value) {
                                    return value;
                                }
                            },
                            tooltips: [
                                false,
                                false
                            ],
                            connect: true,
                            range: {
                                'min': min,
                                'max': max
                            }
                        });
                        slider.on('slide', function (values, handle) {
                            selectedMin = values[0];
                            selectedMax = values[1];
                        });
                        slider.on('set', function (values, handle) {
                            $wire.set('filters.price.min', values[0]);
                            $wire.set('filters.price.max', values[1]);
                        });
                    " class="pt-10">
                    <fieldset>
                        <legend class="block text-sm font-medium text-gray-900">{{ __('Precio') }}</legend>
                        <div class="pt-6 space-y-3">
                            <div x-ref="slider" class="slider-fit"></div>
                            <p class="text-sm text-center text-slate-700">
                                {{ __('from') }} $<span x-text="selectedMin"></span>
                                {{ __('to') }} $<span x-text="selectedMax"></span>
                            </p>
                        </div>
                    </fieldset>
                </div>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <div class="flex justify-end">
                <button x-on:click="show = false" class="w-full btn btn-lg btn-primary">
                    {{ __('Ver Resultados') }}
                </button>
            </div>
        </x-slot:footer>
    </x-slide-over>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('message.processed', () => {
                    window.scrollTo({top: 0, behavior: 'smooth'});
                    refreshImages();
                });
            });

            function refreshImages() {
                const images = document.querySelectorAll('img[srcset*="responsive-images"]');
                window.requestAnimationFrame(function () {
                    for (let i = 0; i < images.length; i++) {
                        const size = images[i].getBoundingClientRect().width;
                        images[i].sizes = Math.ceil(size / window.innerWidth * 100) + 'vw';
                    }
                });
            }
    </script>
    @endpush
</div>