<div x-data="{ mobileMenuOpen: false, searchOpen: false }" x-on:keydown.window.esc="mobileMenuOpen = false">
    {{-- Start mobile menu --}}
    <div x-cloak x-show="mobileMenuOpen" class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
        <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-25"></div>

        <div class="fixed inset-0 z-40 flex">
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-on:click.away="mobileMenuOpen = false"
                class="relative flex flex-col w-full max-w-xs pb-12 overflow-y-auto bg-white shadow-xl">
                <div class="flex px-4 pt-5 pb-2">
                    <button x-on:click="mobileMenuOpen = false" type="button"
                        class="inline-flex items-center justify-center p-2 -m-2 rounded-md text-slate-400">
                        <span class="sr-only">{{ __('Close menu') }}</span>
                        <x-heroicon-o-x-mark class="w-6 h-6" aria-hidden="true" />
                    </button>
                </div>

                <div class="px-4 pt-10 pb-6 space-y-6">
                    <div class="grid items-start grid-cols-1 gap-y-6 gap-x-6">
                        <div>
                            <p class="font-medium text-slate-900">
                                Categoria
                            </p>
                            <ul role="list" aria-labelledby="mobile-collection-heading" class="mt-6 ml-3 space-y-6">
                                <li x-data="{ open: false }">
                                    <span x-on:click="open = !open" class="text-sm font-medium text-slate-900">
                                        Subcategoria
                                    </span>
                                    <ul x-show="open" role="list" aria-labelledby="-heading"
                                        class="mt-6 ml-3 space-y-6 text-sm sm:mt-4 sm:space-y-4">
                                        <li class="flex">
                                            <a href="" class="hover:text-slate-800">
                                                Producto
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="flow-root">
                            <a href="" class="block p-2 -m-2 font-medium text-slate-900">
                                Categorias
                            </a>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-6 space-y-6 border-t border-slate-200">
                    @guest()
                    <div class="flow-root">
                        <a href="{{ route('login') }}" class="block p-2 -m-2 font-medium text-slate-900">
                            {{ __('Login') }}
                        </a>
                    </div>
                    <div class="flow-root">
                        <a href="{{ route('register') }}" class="block p-2 -m-2 font-medium text-slate-900">
                            {{ __('Crear Cuenta') }}
                        </a>
                    </div>
                    @else
                    <div class="flow-root">
                        <a href="{{ route('customer.profile') }}" class="block p-2 -m-2 font-medium text-slate-900">
                            {{ __('Perfil') }}
                        </a>
                    </div>
                    <div class="flow-root">
                        <a href="{{ route('customer.orders.list') }}" class="block p-2 -m-2 font-medium text-slate-900">
                            {{ __('Ordenes') }}
                        </a>
                    </div>
                    <div class="flow-root">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a href="{{ route('logout') }}" class="block p-2 -m-2 font-medium text-slate-900"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Salir') }}
                            </a>
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    {{-- End mobile menu --}}

    <header class="relative bg-white">
        <div class="bg-sky-700">
            <div class="flex items-center justify-between h-10 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <p class="text-sm font-medium text-white">

                </p>
                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">

                    <a href="" class="text-sm font-medium text-white hover:text-gray-100">
                        Politicas de Uso
                    </a>
                    <span class="w-px h-6 bg-sky-600/50" aria-hidden="true"></span>
                </div>
            </div>
        </div>

        <div class="border-b border-slate-200">
            <nav class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    {{-- Mobile menu toggle, controls the 'mobileMenuOpen' state. --}}
                    <div class="flex flex-1 lg:hidden">
                        <button x-on:click="mobileMenuOpen = true" type="button"
                            class="p-2 -ml-2 bg-white text-slate-400">
                            <span class="sr-only">{{ __('Open menu') }}</span>
                            <x-heroicon-m-bars-3 class="w-6 h-6" />
                        </button>
                    </div>

                    {{-- Logo --}}
                    <a href="/">
                        <span class="sr-only">{{ config('app.name') }}</span>
                        <img src="{{ $brandSettings->logo_path ? Storage::url($brandSettings->logo_path) : asset('img/logo.png') }}"
                            alt="{{ config('app.name') }}" class="w-auto h-8" height="32" width="32">
                    </a>

                    {{-- Flyout menus --}}
                    @foreach ($categorias as $categoria)
                    <div class="hidden lg:ml-8 lg:block lg:self-stretch">
                        <div class="flex justify-center h-full space-x-8">
                            <div x-data="{ open: false }" x-on:keydown.escape="open = false" class="flex">
                                <div class="relative flex">
                                    <button x-on:click="open = !open" type="button"
                                        class="relative z-10 flex items-center pt-px -mb-px text-sm font-medium transition-colors duration-200 ease-out border-b-2"
                                        x-bind:class="{ 'border-sky-600 text-sky-600': open, 'border-transparent text-slate-700 hover:text-slate-800': !open }"
                                        x-bind:aria-expanded="open.toString()">
                                        <span>{{ $categoria->categoria }}</span>
                                    </button>
                                </div>
                                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 translate-y-5"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-5" x-on:click.away="open = false"
                                    class="absolute inset-x-0 z-10 text-sm top-full text-slate-500">
                                    <div class="absolute inset-0 bg-white shadow top-1/2" aria-hidden="true"></div>
                                    <div class="relative bg-white">
                                        <div class="px-8 mx-auto max-w-7xl">
                                            <div class="grid grid-cols-5 py-16 text-sm gap-y-10 gap-x-8">
                                                <div>
                                                    <p id="-heading" class="font-medium text-slate-900">
                                                        {{ $categoria->categoria }} </p>
                                                    <ul role="list" aria-labelledby="-heading"
                                                        class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                        @foreach ($subcategorias as $subcategoria)
                                                        @if ($subcategoria->categoria_id === $categoria->id)
                                                        <li class="flex">
                                                            <a href="" class="hover:text-slate-800">
                                                                {{ $subcategoria->subcategoria }}
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="flex items-center justify-end flex-1 lg:ml-auto">
                        <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                            @guest()
                            <a href="{{ route('login') }}"
                                class="text-sm font-medium text-slate-700 hover:text-slate-800">
                                {{ __('Login') }}
                            </a>
                            <span class="w-px h-6 bg-slate-200" aria-hidden="true"></span>
                            <a href="{{ route('register') }}"
                                class="text-sm font-medium text-slate-700 hover:text-slate-800">
                                {{ __('Crear Cuenta') }}
                            </a>
                            @else
                            <x-dropdown>
                                <x-slot:trigger>
                                    <button type="button"
                                        class="flex items-center text-sm font-medium text-slate-700 hover:text-slate-800">
                                        <span>{{ auth()->user()->name }}</span>
                                        <x-heroicon-m-chevron-down class="ml-1.5 -mr-1 h-5 w-5" />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <x-dropdown-link href="{{ route('customer.profile') }}">
                                        {{ __('Perfil') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('customer.orders.list') }}">
                                        {{ __('Ordenes') }}
                                    </x-dropdown-link>
                                    <hr class="border-slate-200" />
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Salir') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot:content>
                            </x-dropdown>
                            @endguest
                        </div>

                        {{-- Spotlight --}}
                        <div class="flex lg:ml-6">
                            <button x-on:click="$dispatch('open-search')"
                                class="p-2 text-slate-400 hover:text-slate-500">
                                <span class="sr-only">{{ __('Search') }}</span>
                                <x-heroicon-o-magnifying-glass class="w-6 h-6" />
                            </button>
                        </div>

                        <!-- Cart -->
                        <div class="flow-root ml-4 lg:ml-6">
                            <a href="{{ route('guest.cart') }}" class="flex items-center p-2 -m-2 group">
                                <x-heroicon-o-shopping-cart
                                    class="flex-shrink-0 w-6 h-6 text-slate-400 group-hover:text-slate-500" />
                                <span class="ml-2 text-sm font-medium text-slate-700 group-hover:text-slate-800">{{
                                    $itemsCount ?? 0 }}</span>
                                <span class="sr-only">{{ __('items in cart, view cart') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</div>