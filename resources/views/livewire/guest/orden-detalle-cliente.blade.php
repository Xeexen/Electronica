<div>
    <div class="max-w-2xl px-4 pt-16 pb-24 mx-auto sm:px-6 lg:max-w-7xl lg:px-8">
        <h1 class="sr-only">{{ __('Dinero') }}</h1>

        <form wire:submit.prevent="placeOrder" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
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
                    <fieldset>
                        <legend class="text-lg font-medium text-slate-900">{{ __('Delivery method') }}</legend>

                        <div class="grid grid-cols-1 mt-4 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            <label
                                class='relative flex p-4 bg-white border rounded-lg shadow-sm cursor-pointer focus:outline-none'>
                                <input wire:model="shippingMethod" type="radio" name="delivery-method" value="1"
                                    class="sr-only" aria-labelledby="delivery-method-1-label"
                                    aria-describedby="delivery-method-1-description-0 delivery-method-1-description-1">
                                <span class="flex flex-1">
                                    <span class="flex flex-col">
                                        <span id="delivery-method-1-label"
                                            class="block text-sm font-medium text-slate-900">
                                            Envio
                                        </span>
                                        <span id="delivery-method-1-description-0"
                                            class="flex items-center mt-1 text-sm text-slate-500">
                                            Envio a domicilio
                                        </span>
                                        <span id="delivery-method-1-description-1"
                                            class="mt-6 text-sm font-medium text-slate-900">
                                            <x-money :amount="20" :currency="config('app.currency')" />
                                        </span>
                                    </span>
                                </span>
                                <x-heroicon-m-check-circle class='w-5 h-5 text-sky-600' aria-hidden="true" />
                            </label>
                        </div>

                        <x-input-error for="shippingMethod" class="mt-2" />
                    </fieldset>
                </div>

                <!-- Billing address -->
                <div class="pt-10 mt-10 border-t border-slate-200">
                    <h2 class="text-lg font-medium text-slate-900">
                        {{ __('Billing information') }}
                    </h2>

                    <div class="grid grid-cols-1 mt-4 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <div class="sm:col-span-2">
                            <div class="flex space-x-2">
                                <div class="flex items-center h-5">
                                    <x-input wire:model.lazy="isBillingSameAsShipping" type="checkbox"
                                        id="same-as-shipping" name="same-as-shipping" class="!rounded !shadow-none" />
                                </div>
                                <x-input-label for="same-as-shipping"
                                    :value="__('Billing address is the same as shipping address')" />
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Payment -->
                <div class="pt-10 mt-10 border-t border-slate-200">
                    <h2 class="text-lg font-medium text-slate-900">
                        {{ __('Payment') }}
                    </h2>
                </div>

                <!-- Notes -->
                <div class="pt-10 mt-10 border-t border-slate-200">
                    <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                        <div class="sm:col-span-2">
                            <x-input-label for="notes" :value="__('Order notes (optional)')" />
                            <div class="mt-1">
                                <x-textarea wire:model.defer="order.notes" name="notes" id="notes"
                                    class="block w-full sm:text-sm"
                                    :placeholder="__('Notes about your order, e.g. special notes for delivery.')" />
                            </div>
                            <x-input-error for="order.notes" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order summary -->
            <div class="mt-10 lg:mt-0">
                <div class="sticky top-4">
                    <h2 class="text-lg font-medium text-slate-900">{{ __('Order summary') }}</h2>

                    <div class="mt-4 bg-white border rounded-lg shadow-sm border-slate-200">
                        <h3 class="sr-only">{{ __('Items in your cart') }}</h3>

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
                                        @if ($categoria === $producto->categoria)
                                        @foreach ($categorias as $categoria)
                                        @if ($subcategoria === $producto->subcategoria)
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
                                    <x-money :amount="$subtotal" :currency="config('app.currency')" />
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

                            <div class="flex items-center justify-between">
                                <dt class="text-sm">{{ __('Shipping') }}</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    <x-money :amount="2.50" :currency="config('app.currency')" />
                                </dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm">{{ __('Taxes') }}</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    <x-money :amount="12%" :currency="config('app.currency')" />
                                </dd>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-slate-200">
                                <dt class="text-base font-medium">{{ __('Total') }}</dt>
                                <dd class="text-base font-medium text-slate-900">
                                    <x-money :amount="$subtotal" :currency="config('app.currency')" />
                                </dd>
                            </div>
                        </dl>

                        <div class="px-4 py-6 border-t border-slate-200 sm:px-6">
                            @if($errors->any())
                            <x-alert type="error" class="mb-4"
                                :message="__('There was an error processing your order. Please verify your information and try again.')" />
                            @endif

                            <button type="submit" class="w-full btn btn-primary btn-xl">
                                {{ __('Confirm order') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>