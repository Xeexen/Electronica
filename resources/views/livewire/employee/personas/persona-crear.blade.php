<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Agregar Persona') }}
    </x-slot:title>

    <!-- Page title & actions -->
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex items-center flex-1 min-w-0 space-x-2">
            <a href="{{ route('employee.personas') }}" class="btn btn-default btn-xs">
                <x-heroicon-m-arrow-left class="w-5 h-5" />
            </a>
            <h1 class="text-2xl font-medium leading-6 text-slate-900 dark:text-slate-100">
                {{ __('Agregar Persona') }}
            </h1>
        </div>
    </div>

    <!-- Page content -->
    <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <form wire:submit.prevent="save" class="space-y-6">
            <x-card>
                <x-slot:content>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-slate-200">
                                {{ __('Revision') }}
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Informacion personal') }}
                            </p>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-5">
                                    <x-input-label for="full-name" value="{{ __('Nombre Completo') }}" />
                                    <x-input wire:model.defer="persona.nombre" type="text" id="full-name"
                                        class="block w-full mt-1 sm:text-sm" />
                                    <x-input-error for="persona.nombre" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="email-address" value="{{ __('Email') }}" />
                                    <x-input wire:model.defer="persona.email" type="email" id="email-address"
                                        class="block w-full mt-1 sm:text-sm" />
                                    <x-input-error for="persona.email" class="mt-2" />
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <x-input-label for="email-address" value="{{ __('Documento') }}" />
                                    <x-input wire:model.defer="persona.documento" type="text" id="email-address"
                                        class="block w-full mt-1 sm:text-sm" />
                                    <x-input-error for="persona.email" class="mt-2" />
                                </div>
                                <div x-data="{ open: false }" class="col-span-6">
                                    <x-input-label for="telefono" value="{{ __('Numero Telefonico/Celular') }}" />
                                    <div class="relative mt-1 rounded-md">
                                        <div class="absolute inset-y-0 left-0 flex items-center">

                                        </div>
                                        <x-input wire:model.defer="persona.telefono" type="text" id="telefono"
                                            class="block w-full pl-[4.5rem] sm:text-sm" />
                                    </div>
                                    <x-input-error for="telefono" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>

            <x-card>
                <x-slot:content>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-slate-900 dark:text-slate-200">
                                {{ __('Direccion') }}
                            </h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Direccion y tipo de persona') }}
                            </p>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6">
                                    <x-input-label for="provincia" :value="__('Provincia')" />
                                    <x-select wire:model="provincia" class="block w-full mt-1 sm:text-sm">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @foreach ($provincias as $provincia)
                                        <option value="{{ $provincia->id }}">{{
                                            $provincia->provincia}}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error for="provincia" class="mt-2" />
                                </div>
                                <div class="col-span-6">
                                    <x-input-label for="provincia" :value="__('Ciudad')" />
                                    <x-select wire:model="persona.ciudad" class="block w-full mt-1 sm:text-sm">
                                        <option value="">{{ __('Seleccione') }}</option>
                                        @if ($listaCiudades)
                                        @foreach ($listaCiudades as $ciudad)
                                        <option value="{{ $ciudad->ciudad }}">{{ $ciudad->ciudad}}</option>
                                        @endforeach
                                        @endif

                                    </x-select>
                                    <x-input-error for="provincia" class="mt-2" />
                                </div>
                                {{-- <div class="col-span-6">
                                    <x-input-label for="ciudad" :value="__('Ciudad')" />
                                    <x-select wire:model="persona.ciudad" class="block w-full mt-1 sm:text-sm">
                                        <option value="">{{ __('Seleccione') }}</option>

                                    </x-select>
                                    <x-input-error for="ciudad" class="mt-2" />
                                </div> --}}

                                <div class="col-span-6">
                                    <x-input-label for="direccion" :value="__('Direccion')" />
                                    <x-input wire:model.defer="persona.direccion" type="text" id="direccion"
                                        class="block w-full mt-1 sm:text-sm" />
                                    <x-input-error for="direccion" class="mt-2" />
                                </div>

                                <div class="col-span-6 md:col-span-2">
                                    <x-input-label for="city" :value="__('Es Cliente?')" />
                                    <x-input wire:model.defer='cliente' type="checkbox" class="mr-2 !rounded" />

                                </div>

                                <div class="col-span-6 md:col-span-2">
                                    <x-input-label for="state" :value="__('Es Proveedor?')" />
                                    <x-input wire:model.defer='proveedor' type="checkbox" class="mr-2 !rounded" />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:content>
            </x-card>
            <div class="flex justify-end">
                <a href="{{ route('employee.personas') }}" class="btn btn-invisible">
                    {{ __('Cancelar') }}
                </a>
                <button type="submit" class="ml-3 btn btn-primary">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>