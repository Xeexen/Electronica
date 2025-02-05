<div>
    <div class="bg-white">
        <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:px-0">
            @unless($carrito->count())
            <div class="mx-auto mb-6 text-center">
                <x-heroicon-o-shopping-cart class="w-24 h-24 mx-auto text-slate-400" />

                <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-200">
                    {{ __('Tu carrito esta ahorita vacio!') }}
                </h3>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Antes de continuar debemos añadir Productos a tu carrito!.') }}
                </p>

                <div class="mt-6">
                    <a href="{{ route('guest.categorias.lista') }}" class="btn btn-primary">
                        {{ __('Continua Comprando') }}
                    </a>
                </div>
            </div>
            @else
            <h1 class="text-3xl font-bold tracking-tight text-center text-slate-900 sm:text-4xl">
                {{ __('Carrito de Compras') }}
            </h1>

            <div class="mt-12">
                <section aria-labelledby="cart-heading">
                    <h2 id="cart-heading" class="sr-only">
                        {{ __('Items en tu carrito:') }}
                    </h2>

                    <ul class="border-t border-b divide-y divide-slate-200 border-slate-200">
                        @foreach($carrito as $carro)
                        @foreach ($productos as $producto)
                        @if ($producto->id === $carro->producto_id)

                        <li class="flex py-6">
                            <div class="flex-shrink-0 border rounded-md border-slate-200">
                                @if($producto->imagen)
                                <img class='object-cover object-center w-24 h-24 rounded-md sm:h-32 sm:w-32' src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">

                                @else
                                <div class="relative w-24 h-24 rounded-md bg-slate-100 sm:h-32 sm:w-32">
                                    <x-heroicon-o-camera
                                        class="absolute inset-0 w-16 h-full mx-auto text-slate-400 sm:w-24" />
                                </div>
                                @endif
                                </img>

                                <div class="flex flex-col flex-1 ml-4 sm:ml-6">
                                    <div>
                                        <div class="flex justify-between">
                                            <h4 class="text-sm">
                                                @foreach ($categorias as $categoria)
                                                @if ($categoria->id == $producto->categoria)
                                                @foreach ($subcategorias as $subcategoria)
                                                @if ($subcategoria->id == $producto->subcategoria)
                                                <a href="{{ route('guest.producto.detalle', ['id' => $producto->id, 'categoria' =>
                                                            $categoria->categoria, 'subcategoria' => $subcategoria->subcategoria, 'producto' => $producto->nombre]) }}"
                                                    class="font-medium text-slate-700 hover:text-slate-800">
                                                    {{ $producto->nombre }}
                                                </a>
                                                @endif
                                                @endforeach
                                                @endif
                                                @endforeach
                                            </h4>
                                            <p class="ml-4 text-sm font-medium text-slate-900">
                                                <x-money :amount="$producto->precio"
                                                    :currency="config('app.currency')" />
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex items-end justify-between flex-1 mt-4">
                                        <div>
                                            <x-input-label for="quantity" class="sr-only" :value="__('Quantity')" />
                                            <x-input
                                                wire:change="updateCartItemQuantity({{ $carro->id }}, $event.target.value)"
                                                type="number" name="quantity" value="{{ $carro->cantidad }}"
                                                id="quantity" class="w-16 text-center no-spinners sm:text-sm" />
                                        </div>
                                        <div class="ml-4">
                                            <button wire:click.prevent="borrar({{ $carro->id }})" type="button"
                                                class="btn btn-link">
                                                <span>{{ __('Eliminar') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </li>
                        @endif
                        @endforeach
                        @endforeach
                    </ul>
                </section>
                <section aria-labelledby="summary-heading" class="mt-10">
                    <h2 id="summary-heading" class="sr-only">
                        {{ __('Items en el carrito') }}
                    </h2>

                    <div>
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between">
                                <dt class="text-base font-medium text-slate-900">
                                    {{ __('Subtotal') }}
                                </dt>
                                <dd class="ml-4 text-base font-medium text-slate-900">
                                    <x-money :amount="$total" :currency="config('app.currency')" />
                                </dd>
                            </div>
                        </dl>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ __('Los impuestos seran calculados en el comprobante.') }}
                        </p>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('guest.orden.crear') }}" class="w-full btn btn-primary btn-xl">
                            {{ __('Pedido') }}
                        </a>
                    </div>

                    <div class="mt-6 text-sm text-center">
                        <p>
                            {{ __('o') }}
                            <a href="{{ route('guest.categorias.lista') }}" class="btn btn-link">
                                {{ __('Continua Comprando') }}
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </p>
                    </div>
                </section>
            </div>
            @endunless
        </div>
    </div>
</div>
