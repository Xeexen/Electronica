<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Productos') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-medium text-slate-900 dark:text-slate-100">
                {{ __('Productos') }}
            </h1>
        </div>
    </div>

    <!-- Page content -->
    <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-card>
            <x-slot:content>
                <div class="max-w-lg mx-auto text-center">
                    <x-heroicon-o-tag class="w-12 h-12 mx-auto text-slate-400" />

                    <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-200">
                        {{ __('¿Que vamos a vender?') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Antes de empezar necesitamos agregar productos') }}
                    </p>

                    <div class="mt-6">
                        <a href="{{route('employee.producto.crear')}}" class="btn btn-primary">
                            <x-heroicon-m-plus class="w-5 h-5 mr-2 -ml-1" />
                            {{ __('Añadir Productos') }}
                        </a>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
        <x-card class="overflow-hidden">
            <x-slot:header>
            </x-slot:header>
            <x-slot:content class="-mx-4 -my-5 sm:-mx-6">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="relative overflow-hidden">
                            <div wire:loading.delay class="absolute inset-0 z-10 bg-slate-100/50 dark:bg-slate-800/50">
                                <div wire:loading.flex class="items-center justify-center w-screen h-full sm:w-auto">
                                    <div class="flex items-center m-auto space-x-2">
                                        <p class="text-sm dark:text-slate-200">{{ 'Loading products...' }}</p>
                                    </div>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                <thead
                                    class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                    <tr>
                                        <th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
                                            <x-input wire:model="selectPage" type="checkbox"
                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 !rounded !shadow-none sm:left-6" />
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Producto') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-center text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Codigo') }}
                                        </th>
                                        <th scope="col"
                                            class="py-4 pl-3 pr-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                            {{ __('Stock') }}
                                        </th>
                                        <th scope="col"
                                            class="py-4 pl-3 pr-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                    @forelse($productos as $product)
                                    <tr wire:loading.class.delay="opacity-50"
                                        class="relative hover:bg-slate-50 dark:hover:bg-slate-800/75">
                                        <td class="relative w-12 px-6 sm:w-16 sm:px-8">

                                            <x-input wire:model="selected" wire:key="checkbox-{{ $product->id }}"
                                                type="checkbox" value="{{ $product->id }}"
                                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 !rounded !shadow-none sm:left-6" />
                                        </td>
                                        <td
                                            class="relative px-3 py-4 text-sm font-medium text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="object-cover object-center w-10 h-10 rounded"
                                                        src="{{ $product->imagen ? asset($product->imagen) : asset('img/placeholder.png') }}">
                                                </div>
                                                <div class="ml-4">
                                                    <a href="{{ route('employee.producto.editar', $product->id) }}"
                                                        class="inline-flex items-center truncate hover:text-sky-600 dark:hover:text-sky-400">
                                                        <span>{{ $product->nombre }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="relative px-3 py-4 text-sm text-center text-slate-500 whitespace-nowrap dark:text-slate-400">
                                            <x-badge :type="$product->is_active ? 'success' : 'default'">
                                                {{ $product->codigo }}
                                            </x-badge>
                                        </td>
                                        <td
                                            class="py-4 pl-3 pr-4 text-sm text-left text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                            {{ $product->unidades}}{{ __( ' :unidades en stock')
                                            }}
                                        </td>
                                        <td
                                            class="py-4 pl-3 pr-4 text-sm text-left text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                            <button class="block btn btn-primary"
                                                wire:click='destroy({{ $product->id }})' type="button">
                                                Eliminar
                                            </button>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="px-3 py-4 text-sm text-center text-slate-500 whitespace-nowrap dark:text-slate-400"
                                            colspan="4">
                                            <div class="max-w-lg mx-auto text-center">
                                                <x-heroicon-o-magnifying-glass
                                                    class="inline-block w-10 h-10 text-slate-400 dark:text-slate-300" />
                                                <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-slate-200">
                                                    {{ __('No existen Productos') }}
                                                </h3>
                                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                                    {{ __('Prueba cambiando los filtros') }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </x-slot:content>
        </x-card>

        <div class="mt-6">
            {{-- {{ $productos->links() }} --}}
        </div>
    </div>
</div>