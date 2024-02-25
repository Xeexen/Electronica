<div>
    <div class="max-w-2xl px-4 pt-16 pb-24 mx-auto sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="sr-only">{{ __('Dinero') }}</h1>

        <form wire:submit.prevent="save" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <div>
                <!-- Contact information -->
                @guest
                <div class="pb-10 mb-10 border-b border-slate-200">
                    <h2 class="text-lg font-medium text-slate-900">
                        {{ __('Informacion del contacto') }}
                    </h2>

                    <div class="mt-4">
                        <x-input-label for="contact-email" class="block text-sm font-medium text-slate-700"
                            :value="__('Email address')" />
                        <div class="mt-1">
                            <x-input wire:model.defer="order.customer_email" type="email" id="contact-email"
                                name="contact-email" autocomplete="email" class="block w-full sm:text-sm" />
                        </div>
                        <x-input-error for="order.customer_email" class="mt-2" />
                    </div>
                    <div class="mt-1">
                        <p class="text-sm">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" class="btn btn-link">
                                {{ __('Logueate') }}
                            </a>
                        </p>
                    </div>
                </div>
                @endguest

                <!-- Delivery method -->
                <div class="pt-10 mt-10 border-t border-slate-200">
                    <legend class="text-lg font-medium text-slate-900">{{ __('Metodo de envio') }}</legend>

                    <div class="grid grid-cols-1 mt-4 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <label
                            class='relative flex p-4 bg-white border rounded-lg shadow-sm cursor-pointer focus:outline-none'>
                            <input wire:model="envio" type="checkbox" name="envio"
                                class="h-4 w-4 !rounded !shadow-none">
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span id="delivery-method-1-label" class="block text-sm font-medium text-slate-900">
                                        Envio
                                    </span>
                                    <span id="delivery-method-1-description-0"
                                        class="flex items-center mt-1 text-sm text-slate-500">
                                        Envio a domicilio
                                    </span>
                                    <span id="delivery-method-1-description-1"
                                        class="mt-6 text-sm font-medium text-slate-900">
                                        <x-money :amount="2.50" :currency="config('app.currency')" />
                                    </span>
                                </span>
                            </span>
                        </label>
                        <label
                            class='relative flex p-4 bg-white border rounded-lg shadow-sm cursor-pointer focus:outline-none'>
                            <input wire:model="retiro" type="checkbox" name="envio"
                                class="h-4 w-4 !rounded !shadow-none">
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span id="delivery-method-1-label" class="block text-sm font-medium text-slate-900">
                                        Retiro en local
                                    </span>
                                    <span id="delivery-method-1-description-0"
                                        class="flex items-center mt-1 text-sm text-slate-500">
                                        Acerquese a nuestras sucursales para retirar sus productos!
                                    </span>
                                    <span id="delivery-method-1-description-1"
                                        class="mt-6 text-sm font-medium text-slate-900">
                                        <x-money :amount="0.00" :currency="config('app.currency')" />
                                    </span>
                                </span>
                            </span>
                        </label>
                    </div>
                    <x-input-error for="shippingMethod" class="mt-2" />
                </div>

                <div class="pt-10 mt-10 border-t border-slate-200">
                    <h2 class="text-lg font-medium text-slate-900">
                        {{ __('Informacion de la factura') }}
                    </h2>

                    <div class="grid grid-cols-1 mt-4 gap-y-6 sm:grid-cols-2 sm:gap-x-4">

                        <div class="sm:col-span-2">
                            <x-input-label for="nombre" :value="__('Tu Nombre')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="persona.nombre" type="text" id="nombre" name="nombre"
                                    autocomplete="given-name" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="nombre" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="documento" :value="__('Documento')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="persona.documento" type="text" name="documento"
                                    id="documento" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="documento" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="direccion" :value="__('Direccion')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="persona.direccion" type="text" name="direccion"
                                    id="direccion" autocomplete="street-address" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="direccion" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="persona.email" type="text" name="email" id="email"
                                    autocomplete="street-address" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="provincia" class="block text-sm font-medium text-slate-700"
                                :value="__('Provincia')" />
                            <div class="mt-1">
                                <x-select wire:model="provincia" id="provincia" name="provincia"
                                    autocomplete="provincia" class="block w-full sm:text-sm">
                                    <option value="">Porfavor Selecione</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{$provincia->id}}">{{$provincia->provincia}}</option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="ciudad" :value="__('Ciudad')" />
                            <div class="mt-1">
                                <x-select wire:model.defer="ciudad" id="ciudad" name="ciudad" autocomplete="ciudad"
                                    class="block w-full sm:text-sm">
                                    <option value="">Porfavor Selecione</option>
                                    @if ($listaCiudades)
                                    @foreach ($listaCiudades as $lista )
                                    <option value="{{$lista->id}}">{{$lista->ciudad}}</option>

                                    @endforeach
                                    @endif
                                </x-select>
                            </div>
                            <x-input-error for="ciudad" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="telefono" :value="__('Telefono')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="persona.telefono" type="text" name="telefono" id="telefono"
                                    class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="telefono" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="pt-10 mt-10 border-t border-slate-200">
                    <h2 class="text-lg font-medium text-slate-900">
                        {{ __('Metodo de pago') }}
                    </h2>

                    <div class="grid grid-cols-1 mt-4 gap-y-6 sm:grid-cols-2 sm:gap-x-4">

                        <div class="sm:col-span-2">
                            <x-input-label for="numero" :value="__('Numero de tarjeta')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="numero" type="text" id="numero" name="numero"
                                    autocomplete="given-name" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="numero" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="cvv" :value="__('CVV')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="cvv" type="text" name="cvv" id="cvv"
                                    autocomplete="address-level2" class="block w-full sm:text-sm" />
                            </div>
                            <x-input-error for="cvv" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="fecha" class="block text-sm font-medium text-slate-700"
                                :value="__('Fecha de Expiracion')" />
                            <div class="mt-1">
                                <x-input wire:model.defer="fecha" type="text"
                                    class="block w-full py-2 text-base border-gray-300 rounded-md start-date-input focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>
                            <x-input-error for="fecha" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order summary -->
            <div class="mt-10 lg:mt-0">
                <div class="sticky top-4">
                    <h2 class="text-lg font-medium text-slate-900">{{ __('Tu Orden') }}</h2>

                    <div class="mt-4 bg-white border rounded-lg shadow-sm border-slate-200">
                        <h3 class="sr-only">{{ __('Productos en tu carrito:') }}</h3>

                        <ul role="list" class="text-sm text-gray-900 divide-y divide-gray-200">
                            @foreach($carrito as $carro)
                            @foreach ($productos as $producto)
                            @if ($producto->id === $carro->producto_id)
                            <li class="flex items-center px-4 py-6 space-x-4 sm:px-6">
                                <div class="relative flex flex-shrink-0 border rounded-md border-slate-200">

                                    <div class="relative w-20 h-20 rounded-md bg-slate-100">
                                        <x-heroicon-o-camera
                                            class="absolute inset-0 w-12 h-full mx-auto text-slate-400 sm:w-16" />
                                    </div>
                                    <span
                                        class="absolute -top-3 -right-2 whitespace-nowrap rounded-full bg-slate-400 px-2 py-0.5 text-center text-xs font-medium leading-5 text-white ring-1 ring-inset ring-slate-400 tabular-nums">{{
                                        $carro->cantidad }}</span>
                                </div>
                                <div class="flex-auto ml-6 space-y-1">
                                    <h4 class="line-clamp-2">
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


                                </div>
                                <p class="flex flex-col space-y-1 font-medium text-right">
                                    <x-money :amount="$producto->precio" :currency="config('app.currency')" />
                                </p>
                            </li>
                            @endif
                            @endforeach
                            @endforeach
                        </ul>

                        <dl class="px-4 py-6 space-y-6 border-t border-slate-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">{{ __('Subtotal') }}</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    <x-money :amount="$subtotal" :currency="config('app.currency')" />
                                </dd>
                            </div>
                            @if($envio)
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">{{ __('Envio') }}</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    <x-money :amount="
                                    2.50
                                    " :currency="config('app.currency')" />
                                </dd>
                            </div>
                            @endif
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">{{ __('Impuestos') }}</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    <x-money :amount="$impuesto" :currency="config('app.currency')" />
                                </dd>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200">
                                <dt class="text-base font-medium">{{ __('Total') }}</dt>
                                <dd class="text-base font-medium text-slate-900">
                                    <x-money :amount="$total" :currency="config('app.currency')" />
                                </dd>
                            </div>
                        </dl>

                        <div class="px-4 py-6 border-t border-slate-200 sm:px-6">
                            @if($errors->any())
                            <x-alert type="error" class="mb-4"
                                :message="__('Hubo un error procesando la compra, verifique sus datos e intentelo de nuevo!')" />
                            @endif

                            <button type="submit" class="w-full btn btn-primary btn-xl">
                                {{ __('Confirmar Orden') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>