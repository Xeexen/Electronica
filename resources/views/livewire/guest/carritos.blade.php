<div>
    <div class="bg-white">
        <div class="max-w-2xl px-4 py-16 mx-auto sm:px-6 sm:py-24 lg:px-0">
            @unless($carrito->count())
            <div class="mx-auto mb-6 text-center">
                <x-heroicon-o-shopping-cart class="w-24 h-24 mx-auto text-slate-400" />

                <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-200">
                    {{ __('Your shopping cart is currently empty') }}
                </h3>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Before proceed to checkout you must add some products to your shopping cart.') }}
                </p>

                <div class="mt-6">
                    <a href="{{ route('guest.products.list') }}" class="btn btn-primary">
                        {{ __('Continue shopping') }}
                    </a>
                </div>
            </div>
            @else
            <h1 class="text-3xl font-bold tracking-tight text-center text-slate-900 sm:text-4xl">
                {{ __('Shopping Cart') }}
            </h1>

            <div class="mt-12">
                <section aria-labelledby="cart-heading">
                    <h2 id="cart-heading" class="sr-only">
                        {{ __('Items in your shopping cart') }}
                    </h2>

                    <ul role="list" class="border-t border-b divide-y divide-slate-200 border-slate-200">
                        @foreach($carrito as $producto)
                        <li class="flex py-6">
                            <div class="flex-shrink-0 border rounded-md border-slate-200">
                                @if($producto->imagen)
                                {{ $producto->imagen->attributes(['alt' => $producto->nombre, 'class' => 'h-24 w-24
                                rounded-md object-cover object-center sm:h-32 sm:w-32']) }}
                                @else
                                <div class="relative w-24 h-24 rounded-md bg-slate-100 sm:h-32 sm:w-32">
                                    <x-heroicon-o-camera
                                        class="absolute inset-0 w-16 h-full mx-auto text-slate-400 sm:w-24" />
                                </div>
                                @endif
                            </div>

                            <div class="flex flex-col flex-1 ml-4 sm:ml-6">
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="text-sm">
                                            <a href="{{ route('guest.producto.detalle', ['id' => $producto->id, 'categoria' => 
                                            , 'subcategoria' => $subcategoria->subcategoria, 'producto' => $producto->nombre]) }}"
                                                class="font-medium text-slate-700 hover:text-slate-800">
                                                {{ $producto->nombre }}
                                            </a>
                                        </h4>
                                        <p class="ml-4 text-sm font-medium text-slate-900">
                                            <x-money :amount="$item->price" :currency="config('app.currency')" />
                                        </p>
                                    </div>
                                    @if($item->variant->variantAttributes->count())
                                    <ul class="mt-1 space-x-2 text-sm divide-x divide-slate-200 text-slate-500">
                                        @foreach($item->variant->variantAttributes as $attribute)
                                        <li @class(['inline', 'pl-2'=> !$loop->first])>{{ $attribute->optionValue->label
                                            }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>

                                <div class="flex items-end justify-between flex-1 mt-4">
                                    <div>
                                        <x-input-label for="quantity" class="sr-only" :value="__('Quantity')" />
                                        <x-input
                                            wire:change="updateCartItemQuantity({{ $item->id }}, $event.target.value)"
                                            type="number" name="quantity" value="{{ $item->quantity }}" id="quantity"
                                            class="w-16 text-center no-spinners sm:text-sm" />
                                    </div>
                                    <div class="ml-4">
                                        <button wire:click.prevent="removeCartItem({{ $item->id }})" type="button"
                                            class="btn btn-link">
                                            <span>{{ __('Remove') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>
                <section aria-labelledby="summary-heading" class="mt-10">
                    <h2 id="summary-heading" class="sr-only">
                        {{ __('Order summary') }}
                    </h2>

                    <div>
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between">
                                <dt class="text-base font-medium text-slate-900">
                                    {{ __('Subtotal') }}
                                </dt>
                                <dd class="ml-4 text-base font-medium text-slate-900">
                                    <x-money :amount="$cart->subtotal" :currency="config('app.currency')" />
                                </dd>
                            </div>
                        </dl>
                        <p class="mt-1 text-sm text-slate-500">
                            {{ __('Shipping and taxes will be calculated at checkout.') }}
                        </p>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('guest.checkout') }}" class="w-full btn btn-primary btn-xl">
                            {{ __('Checkout') }}
                        </a>
                    </div>

                    <div class="mt-6 text-sm text-center">
                        <p>
                            {{ __('or') }}
                            <a href="{{ route('guest.products.list') }}" class="btn btn-link">
                                {{ __('Continue Shopping') }}
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