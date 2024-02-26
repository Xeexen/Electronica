<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Clientes/Proveedores') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-medium text-slate-900 dark:text-slate-100">
                {{ __('Clientes/Proveedores') }}
            </h1>
        </div>
        <div class="flex mt-4 sm:mt-0 sm:ml-4">
            <a href="{{ route('employee.persona.crear') }}"
                class="block w-full btn btn-primary order-0 sm:order-1 sm:ml-3">
                {{ __('Añadir Cliente o Proveedor') }}
            </a>
        </div>
    </div>

    <!-- Page content -->
    <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-card class="overflow-hidden">
            <x-slot:content class="-mx-4 -my-5 sm:-mx-6">
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <div class="relative overflow-hidden">
                            <div wire:loading.delay class="absolute inset-0 z-10 bg-slate-100/50 dark:bg-slate-800/50">
                                <div wire:loading.flex class="items-center justify-center w-screen h-full sm:w-auto">
                                    <div class="flex items-center m-auto space-x-2">
                                        <p class="text-sm dark:text-slate-200">{{ 'Loading customers...' }}</p>
                                    </div>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                <thead
                                    class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                    <tr>

                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Nombre del Cliente') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Ordenes') }}
                                        </th>
                                        <th scope="col"
                                            class="py-4 pl-3 pr-4 text-sm font-semibold tracking-wide text-right text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                            {{ __('Dinero Gastado') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                    @forelse($personas as $customer)
                                    <tr wire:loading.class.delay="opacity-50"
                                        class="relative hover:bg-slate-50 dark:hover:bg-slate-800/75">

                                        <td
                                            class="relative px-3 py-4 text-sm font-medium text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <a href=""
                                                        class="inline-flex items-center truncate hover:text-sky-600 dark:hover:text-sky-400">
                                                        {{ $customer->nombre }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="relative px-3 py-4 text-sm text-left text-slate-500 whitespace-nowrap dark:text-slate-400">
                                            {{-- {{ $ordenes}} --}}
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
                                                    {{ __('No se encontraron Clientes') }}
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
            {{-- {{ $customers->links() }} --}}
        </div>
    </div>
</div>