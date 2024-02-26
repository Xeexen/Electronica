<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Facturas') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-medium text-slate-900 dark:text-slate-100">
                {{ __('Facturas') }}
            </h1>
        </div>
    </div>

    <!-- Page content -->
    <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-card>
            <x-slot:content>
                <div class="max-w-lg mx-auto text-center">
                    <x-heroicon-o-inbox-arrow-down class="w-12 h-12 mx-auto text-slate-400" />

                    <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-200">
                        {{ __('Tus Facturas!') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Las facturas que tengas se mostraran aqui!') }}
                    </p>
                    <div class="mt-6">
                        <a href="{{route('employee.factura.crear')}}" class="btn btn-primary">
                            <x-heroicon-m-plus class="w-5 h-5 mr-2 -ml-1" />
                            {{ __('Crear Factura') }}
                        </a>
                    </div>
                </div>
            </x-slot:content>
        </x-card>
        <x-card class="overflow-hidden">

            <x-slot:content>
                <div class="-mx-4 -my-5 overflow-x-auto sm:-mx-6">
                    <div class="inline-block min-w-full align-middle">
                        <div class="relative overflow-hidden">
                            <div wire:loading.delay class="absolute inset-0 z-10 bg-slate-100/50 dark:bg-slate-800/50">
                                <div wire:loading.flex class="items-center justify-center w-screen h-full sm:w-auto">
                                    <div class="flex items-center m-auto space-x-2">
                                        <p class="text-sm dark:text-slate-200">{{ 'Loading orders...' }}</p>
                                    </div>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                <thead
                                    class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('ID') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Cliente') }}
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-4 text-sm font-semibold tracking-wide text-right text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            {{ __('Total') }}
                                        </th>
                                        <th scope="col"
                                            class="py-4 pl-3 pr-4 text-sm font-semibold tracking-wide text-right text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                            {{ __('Fecha') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                    @forelse($facturas as $factura)
                                    <tr wire:loading.class.delay="opacity-50"
                                        class="relative hover:bg-slate-50 dark:hover:bg-slate-800/75">
                                        <td
                                            class="relative px-3 py-4 text-sm font-medium text-left text-slate-900 whitespace-nowrap tabular-nums dark:text-slate-200">
                                            <label class="hover:text-sky-600 dark:hover:text-sky-400">
                                                {{ $factura->id }}
                                            </label>
                                        </td>
                                        <td
                                            class="relative px-3 py-4 text-sm text-left text-slate-900 whitespace-nowrap dark:text-slate-200">
                                            <span class="text-gray-500">
                                                @foreach ($clientes as $cliente)
                                                @if ($cliente->id === $factura->cliente_id)
                                                {{ $cliente->nombre }}
                                                @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td
                                            class="relative px-3 py-4 text-sm text-right text-slate-500 whitespace-nowrap tabular-nums dark:text-slate-400">
                                            <x-money :amount="$factura->total" />
                                        </td>
                                        <td
                                            class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 whitespace-nowrap tabular-nums sm:pr-6 dark:text-slate-400">
                                            {{ $factura->created_at }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="px-3 py-4 text-sm text-center text-slate-500 whitespace-nowrap dark:text-slate-400"
                                            colspan="8">
                                            <div class="max-w-lg mx-auto text-center">
                                                <x-heroicon-o-magnifying-glass
                                                    class="inline-block w-10 h-10 text-slate-400 dark:text-slate-300" />
                                                <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-slate-200">
                                                    {{ __('Aun no tenemos facturas') }}
                                                </h3>
                                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                                    {{ __('Aqui esta tu lista de facturas!') }}
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
    </div>
</div>