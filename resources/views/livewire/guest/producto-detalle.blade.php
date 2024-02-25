<div>
    <div class="border-b border-slate-200">
        <nav aria-label="Breadcrumb" class="px-4 mx-auto overflow-hidden max-w-7xl whitespace-nowrap sm:px-6 lg:px-8">
            <ol role="list" class="flex items-center py-4 space-x-4">
                <li>
                    <div class="flex items-center">
                        <a href="/" class="mr-4 text-sm font-medium text-slate-900">
                            {{ __('Home') }}
                        </a>
                        <svg viewBox="0 0 6 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            class="w-auto h-5 text-slate-300">
                            <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('guest.products.list') }}" class="mr-4 text-sm font-medium text-slate-900">
                            {{ __('Todos los productos') }}
                        </a>
                        <svg viewBox="0 0 6 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            class="w-auto h-5 text-slate-300">
                            <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                        </svg>
                    </div>
                </li>
                <li class="text-sm truncate">
                    <a href="{{ route('guest.products.detail', $producto) }}" aria-current="page"
                        class="font-medium text-slate-500 hover:text-slate-600">
                        {{ $producto->name }}
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <main class="max-w-2xl py-16 mx-auto sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
            <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}"
                class="object-cover object-center w-full h-full sm:rounded-lg">
            <!-- Product info -->
            <div class="px-4 mt-10 sm:mt-16 sm:px-0 lg:mt-0">
                <!-- Title -->
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    {{ $producto->nombre }}
                </h1>

                <!-- Price -->
                <div class="mt-3">
                    <h2 class="sr-only">
                        {{ __('Informacion del Producto') }}
                    </h2>
                    <p class="text-3xl tracking-tight text-slate-900">
                        <x-money :amount="$producto->precio" :currency="config('app.currency')" />
                    </p>
                </div>
                <!-- Variants -->
                <form wire:submit.prevent="añadirCarrito" class="mt-6">
                    <div class="flex items-center mt-8 space-x-3">
                        <div>
                            <x-input-label for="cantidad" :value="__('Cantidad')" class="sr-only" />
                            <x-input wire:model.lazy="carrito.cantidad" type="number" id="cantidad"
                                class="py-3 text-sm text-center w-28 sm:text-base show-spinners" :min="1" :max="$producto->unidades" />
                            <x-input-error for="addToCart.quantity" />
                        </div>
                        <div class="flex w-full">
                            <button wire:loading.delay.attr="disabled" class="w-full btn btn-primary btn-xl"
                                @disabled($producto->unidades < 1)>
                                    {{ $producto->unidades >= 1 ? __('Añadir al carrito') : __('No hay existencias') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div wire:ignore class="px-4 mt-10 sm:px-0 lg:max-w-none">
            <div x-data="tabs" x-id="['tabs']"
                x-on:show-product-reviews.window="select($id('tabs', 2)); $el.scrollIntoView({ behavior: 'smooth'} )">
                <div class="border-b border-slate-200">
                    <ul x-bind="tablist" class="flex -mb-px space-x-8" aria-orientation="horizontal" role="tablist">
                        <li>
                            <button x-bind="tab" id="tab-description"
                                class="py-6 text-sm font-medium border-b-2 whitespace-nowrap"
                                :class="isSelected($el.id) ? 'border-sky-600 text-sky-600' : 'border-transparent text-slate-700 hover:text-slate-800 hover:border-slate-300'"
                                aria-controls="tab-panel-description" role="tab" type="button">
                                {{ __('Descripcion del Producto') }}
                            </button>
                        </li>   
                        <li>
                            <button x-bind="tab" id="tab-reviews"
                                class="py-6 text-sm font-medium border-b-2 whitespace-nowrap"
                                :class="isSelected($el.id) ? 'border-sky-600 text-sky-600' : 'border-transparent text-slate-700 hover:text-slate-800 hover:border-slate-300'"
                                aria-controls="tab-panel-reviews" role="tab" type="button">
                                {{ __('Customer Reviews') }}
                            </button>
                        </li>
                    </ul>
                </div>

                <div>
                    <div x-show="isSelected($id('tabs', whichChild($el, $el.parentElement)))" id="tab-panel-description"
                        class="pt-6" role="tabpanel" tabindex="0" aria-labelledby="tab-description">
                        <h3 class="sr-only">{{ __('Product Description') }}</h3>

                        <div class="prose-sm prose prose-slate max-w-none">
                            {!! $producto->descripcion !!}
                        </div>
                    </div>
                    <div x-cloak x-show="isSelected($id('tabs', whichChild($el, $el.parentElement)))"
                        id="tab-panel-reviews" class="-mb-10" role="tabpanel" tabindex="0"
                        aria-labelledby="tab-reviews">
                        <h3 class="sr-only">{{ __('Customer Reviews') }}</h3>
                    </div>
                </div>
            </div>
        </div>        
    </main>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
                Alpine.data('tabs', () => ({
                    selectedId: null, init() {
                        this.$nextTick(() => this.select(this.$id('tabs', 1)))
                    }, select(id) {
                        this.selectedId = id
                    }, isSelected(id) {
                        return this.selectedId === id
                    }, whichChild(el, parent) {
                        return Array.from(parent.children).indexOf(el) + 1
                    }
                }))
                Alpine.bind('tablist', () => ({
                    ['x-ref']: 'tablist', ['@keydown.right.prevent.stop']() {
                        this.$focus.wrap().next()
                    }, ['@keydown.home.prevent.stop']() {
                        this.$focus.first()
                    }, ['@keydown.page-up.prevent.stop']() {
                        this.$focus.first()
                    }, ['@keydown.left.prevent.stop']() {
                        this.$focus.wrap().prev()
                    }, ['@keydown.end.prevent.stop']() {
                        this.$focus.last()
                    }, ['@keydown.page-down.prevent.stop']() {
                        this.$focus.last()
                    },
                }))
                Alpine.bind('tab', () => ({
                    [':id']() {
                        return this.$id('tabs', this.whichChild(this.$el.parentElement, this.$refs.tablist))
                    }, ['@click']() {
                        this.select(this.$el.id)
                    }, ['@focus']() {
                        this.select(this.$el.id)
                    }, [':tabindex']() {
                        return this.isSelected(this.$el.id) ? 0 : -1
                    }, [':aria-selected']() {
                        return this.isSelected(this.$el.id)
                    }, [':class']() {
                        return this.isSelected(this.$el.id) ? 'border-sky-600 text-sky-600' : 'border-transparent text-slate-700 hover:text-slate-800 hover:border-slate-300'
                    },
                }))
            })
    </script>
    @endpush
</div>