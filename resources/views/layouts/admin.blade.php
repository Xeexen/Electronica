<!DOCTYPE html>
<html x-cloak x-data="{ theme: $persist('light') }"
    x-bind:class="{ 'dark': theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <!-- Title -->
    <title>{{ isset($title) ? $title . ' - ' . $generalSettings->store_name : $generalSettings->store_name }}</title>

    <!-- Favicon -->
    <link rel="icon"
        href="{{ $brandSettings->favicon_path ? Storage::url($brandSettings->favicon_path) : asset('img/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @livewireStyles
    @vite('resources/css/admin.css')
</head>

<body id="main" class="h-full font-sans antialiased bg-white dark:bg-slate-900">
    <div x-data="{ sidebarOpen: false }" x-on:keydown.window.esc="sidebarOpen = false">
        {{-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. --}}
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-slate-900/80"></div>

            <div class="fixed inset-0 flex">
                <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-on:click.away="sidebarOpen = false" class="relative flex flex-1 w-full max-w-xs mr-16">
                    <div x-show="sidebarOpen" x-transition:enter="ease-in-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute top-0 flex justify-center w-16 pt-5 left-full">
                        <button x-on:click="sidebarOpen = false" type="button" class="-m-2.5 p-2.5">
                            <span class="sr-only">{{ __('Close sidebar') }}</span>
                            <x-heroicon-o-x-mark class="w-6 h-6 text-white" />
                        </button>
                    </div>

                    <div
                        class="flex flex-col px-6 pb-4 overflow-y-auto bg-white grow gap-y-5 dark:bg-slate-900 dark:ring-1 dark:ring-white/10">
                        <div class="flex items-center h-16 shrink-0">
                            <img src="{{ $brandSettings->logo_path ? Storage::url($brandSettings->logo_path) : asset('img/logo.png') }}"
                                alt="{{ config('app.name') }}" class="w-auto h-8">
                        </div>
                        <nav class="flex flex-col flex-1" aria-label="Main navigation">
                            <ul class="flex flex-col flex-1 gap-y-7">
                                <li>
                                    <ul class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('employee.dashboard') }}" @class(['group flex gap-x-3
                                                rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.dashboard'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.dashboard')])
                                                >
                                                <x-heroicon-o-home @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.dashboard'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.dashboard')]) />
                                                    {{ __('Panel') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employee.ordenes.lista') }}" @class(['group flex gap-x-3
                                                rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.ordenes.lista.*'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.ordenes.lista.*')])
                                                >
                                                <x-heroicon-o-inbox @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.ordenes.lista.*'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.ordenes.lista.*')]) />
                                                    {{ __('Ordenes') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employee.productos') }}" @class(['group flex gap-x-3
                                                rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.productos.*'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.productos.*')])
                                                >
                                                <x-heroicon-o-tag @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.productos.*'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.productos.*')]) />
                                                    {{ __('Productos') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employee.personas') }}" @class(['group flex gap-x-3
                                                rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.personas.*'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.customers.*')])
                                                >
                                                <x-heroicon-o-users @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.personas.*'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.personas.*')]) />
                                                    {{ __('Clientes/Proveedores') }}
                                            </a>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ route('employee.shipping.manager') }}" @class(['group flex
                                                gap-x-3 rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.shipping.*'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.shipping.*')])
                                                >
                                                <x-heroicon-o-truck @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.shipping.*'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.shipping.*')]) />
                                                    {{ __('Inventarios') }}
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a href="{{ route('employee.facturas.lista') }}" @class(['group flex gap-x-3
                                                rounded-md p-2 text-sm leading-6
                                                font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                request()->routeIs('employee.articles.*'), 'text-slate-700
                                                hover:text-sky-600 hover:bg-gray-50 dark:text-slate-300
                                                dark:hover:bg-slate-800 dark:hover:text-white' =>
                                                !request()->routeIs('employee.facturas.lista.*')])
                                                >
                                                <x-heroicon-o-document-text @class(['h-6 w-6
                                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                                    request()->routeIs('employee.articles.*'), 'text-slate-400
                                                    group-hover:text-sky-600 dark:group-hover:text-white
                                                    dark:group-hover:bg-slate-800' =>
                                                    !request()->routeIs('employee.articles.*')])/>
                                                    {{ __('Ventas') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="mt-auto">
                                    <a href="{{ route('employee.settings.general') }}" @class(['group -mx-2 flex gap-x-3
                                        rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50
                                        hover:text-sky-600', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.settings.*'), 'text-slate-700 hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.settings.*')])
                                        >
                                        <x-heroicon-o-cog-6-tooth @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.settings.*'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.settings.*')]) />
                                            {{ __('Settings') }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- Static sidebar for desktop --}}
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
            <div
                class="flex flex-col px-6 pb-4 overflow-y-auto bg-white border-r grow gap-y-5 border-slate-200 dark:bg-slate-900 dark:border-white/10">
                <div class="flex items-center h-16 shrink-0">
                    <img src="{{ $brandSettings->logo_path ? Storage::url($brandSettings->logo_path) : asset('img/logo.png') }}"
                        alt="{{ config('app.name') }}" class="w-auto h-8">
                </div>
                <nav class="flex flex-col flex-1">
                    <ul role="list" class="flex flex-col flex-1 gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('employee.dashboard') }}" @class(['group flex gap-x-3 rounded-md
                                        p-2 text-sm leading-6
                                        font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.dashboard'), 'text-slate-700 hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.dashboard')])
                                        >
                                        <x-heroicon-o-home @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.dashboard'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.dashboard')]) />
                                            {{ __('Dashboard') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.ordenes.lista') }}" @class(['group flex gap-x-3
                                        rounded-md p-2 text-sm leading-6
                                        font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.ordenes.lista.*'), 'text-slate-700
                                        hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.ordenes.lista.*')])
                                        >
                                        <x-heroicon-o-inbox @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.ordenes.lista.*'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.ordenes.lista.*')])
                                            />
                                            {{ __('Ordenes') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.productos') }}" @class(['group flex gap-x-3 rounded-md
                                        p-2 text-sm leading-6
                                        font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.productos.*'), 'text-slate-700 hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.productos.*')])
                                        >
                                        <x-heroicon-o-tag @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.productos.*'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.productos.*')]) />
                                            {{ __('Productos') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.personas') }}" @class(['group flex gap-x-3 rounded-md
                                        p-2 text-sm leading-6
                                        font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.customers.*'), 'text-slate-700 hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.customers.*')])
                                        >
                                        <x-heroicon-o-users @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.personas.*'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.personas.*')]) />
                                            {{ __('Clientes/Proveedores') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.facturas.lista') }}" @class(['group flex gap-x-3
                                        rounded-md p-2 text-sm leading-6
                                        font-semibold', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                        request()->routeIs('employee.articles.*'), 'text-slate-700 hover:text-sky-600
                                        hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800
                                        dark:hover:text-white' => !request()->routeIs('employee.articles.*')])
                                        >
                                        <x-heroicon-o-document-text @class(['h-6 w-6
                                            shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                            request()->routeIs('employee.articles.*'), 'text-slate-400
                                            group-hover:text-sky-600 dark:group-hover:text-white
                                            dark:group-hover:bg-slate-800' =>
                                            !request()->routeIs('employee.articles.*')])/>
                                            {{ __('Ventas') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @if(!$is_local && !$is_staging && !$generalSettings->license_active)
                        <li>
                            <div class="p-4 mx-auto space-y-3 text-center rounded-md bg-slate-50 dark:bg-white/5">
                                <p class="text-sm text-slate-900 dark:text-slate-200">
                                    {{ __('Fill out your license key to activate your store and accept live payments.')
                                    }}
                                </p>
                                <a href="{{ route('employee.settings.license') }}" class="btn btn-primary btn-sm">
                                    {{ __('Activate your store') }}
                                </a>
                            </div>
                        </li>
                        @endif

                        <li class="mt-auto">
                            <a href="{{ route('employee.settings.general') }}" @class(['group -mx-2 flex gap-x-3
                                rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50
                                hover:text-sky-600', 'bg-slate-50 text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                request()->routeIs('employee.settings.*'), 'text-slate-700 hover:text-sky-600
                                hover:bg-gray-50 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white' =>
                                !request()->routeIs('employee.settings.*')])
                                >
                                <x-heroicon-o-cog-6-tooth @class(['h-6 w-6
                                    shrink-0', 'text-sky-600 dark:bg-slate-800 dark:text-white'=>
                                    request()->routeIs('employee.settings.*'), 'text-slate-400 group-hover:text-sky-600
                                    dark:group-hover:text-white dark:group-hover:bg-slate-800' =>
                                    !request()->routeIs('employee.settings.*')]) />
                                    {{ __('Ajustes') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="lg:pl-72">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8">
                <div
                    class="flex items-center h-16 px-4 bg-white border-b shadow-sm gap-x-4 border-slate-200 sm:gap-x-6 sm:px-6 lg:px-0 lg:shadow-none dark:bg-slate-900 dark:border-white/10">
                    <button x-on:click="sidebarOpen = true" type="button"
                        class="-m-2.5 p-2.5 text-slate-700 lg:hidden dark:text-slate-400">
                        <span class="sr-only">{{ __('Open sidebar') }}</span>
                        <x-heroicon-o-bars-3 class="w-6 h-6" aria-hidden="true" />
                    </button>

                    <!-- Separator -->
                    <div class="w-px h-6 bg-slate-200 lg:hidden dark:bg-white/5" aria-hidden="true"></div>

                    <div class="flex self-stretch flex-1 gap-x-4 lg:gap-x-6">
                        <div class="relative flex flex-1">
                            <button class="relative w-full" x-on:click="$dispatch('open-search')">
                                <x-heroicon-o-magnifying-glass
                                    class="absolute inset-y-0 left-0 w-5 h-full pointer-events-none text-slate-400 dark:text-slate-500"
                                    aria-hidden="true" />
                                <span
                                    class="items-center hidden w-full h-full pl-8 pr-0 sm:flex text-slate-400 focus:ring-0 sm:text-sm dark:bg-slate-900 dark:text-slate-500">
                                    {{ __('Search the site (Press "/" to focus)') }}
                                </span>
                            </button>
                        </div>
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <x-dropdown>
                                <x-slot:trigger>
                                    <button type="button" class="-mr-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">
                                            {{ __('Change theme') }}
                                        </span>
                                        <x-heroicon-o-sun class="w-6 h-6" x-show="theme === 'light'" x-cloak />
                                        <x-heroicon-o-moon class="w-6 h-6" x-show="theme === 'dark'" x-cloak />
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <x-dropdown-link x-on:click="theme = 'light'" role="button"
                                        class="flex items-center space-x-2">
                                        <x-heroicon-o-sun class="w-5 h-5" />
                                        <span>{{ __('Light') }}</span>
                                    </x-dropdown-link>
                                    <x-dropdown-link x-on:click="theme = 'dark'" role="button"
                                        class="flex items-center space-x-2">
                                        <x-heroicon-o-moon class="w-5 h-5" />
                                        <span>{{ __('Dark') }}</span>
                                    </x-dropdown-link>
                                </x-slot:content>
                            </x-dropdown>

                            <!-- Separator -->
                            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-slate-200 dark:bg-white/10"
                                aria-hidden="true"></div>

                            <!-- Profile dropdown -->
                            <x-dropdown>
                                <x-slot:trigger>
                                    <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
                                        :aria-expanded="open.toString()" aria-haspopup="true">
                                        <span class="sr-only">{{ __('Open user menu') }}</span>
                                        <img class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800"
                                            src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                            alt="{{ auth()->user()->name }}">
                                        <span class="hidden lg:flex lg:items-center">
                                            <span
                                                class="ml-4 text-sm font-semibold leading-6 text-gray-900 dark:text-white"
                                                aria-hidden="true">
                                                {{ auth()->user()->name }}
                                            </span>
                                            <x-heroicon-m-chevron-down class="w-5 h-5 ml-2 text-gray-400"
                                                aria-hidden="true" />
                                        </span>
                                    </button>
                                </x-slot:trigger>
                                <x-slot:content>
                                    <x-dropdown-link href="{{ route('employee.profile') }}">
                                        {{ __('Personal profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('employee.profile') }}">
                                        {{ __('Change password') }}
                                    </x-dropdown-link>
                                    <hr class="border-slate-200 dark:border-white/10" />
                                    <div
                                        class="relative block px-4 py-2 text-sm leading-5 transition duration-150 ease-in-out cursor-pointer text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 dark:text-slate-200 dark:focus:bg-slate-900/40 dark:hover:bg-slate-900/40">
                                        <livewire:employee.auth.logout />
                                    </div>
                                </x-slot:content>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10">
                {{ $slot }}
            </main>
        </div>
    </div>

    <livewire:components.spotlight />

    <x-notification />

    <!-- Scripts -->
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    @vite('resources/js/admin.js')
    @stack('scripts')
</body>

</html>
