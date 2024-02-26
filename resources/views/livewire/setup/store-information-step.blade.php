<div>
    <form wire:submit.prevent="save">
        <x-card>
            <x-slot:header class="border-b border-slate-200 dark:border-white/10">
                <h3 class="text-base font-semibold leading-6 text-slate-900 dark:text-slate-200">
                    {{ __('Informacion de la tienda') }}
                </h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('') }}
                </p>
            </x-slot:header>

            <x-slot:content>
                <div class="space-y-6">
                    <div>
                        <x-input-label for="storeNameInput" :value="__('Nombre de la Tienda')" />
                        <x-input wire:model.defer="state.store_name" type="text" id="storeNameInput"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('Mi Tienda') }}" />
                        <x-input-error for="state.store_name" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="ruc" :value="__('Ruc')" />
                        <x-input wire:model.defer="empresa.ruc" type="text" id="ruc"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('Ruc') }}" />
                        <x-input-error for="empresa.ruc" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="storeSloganInput" :value="__('Slogan')" />
                        <x-input wire:model.defer="state.store_slogan" type="text" id="storeSloganInput"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('El slogan de tu tienda') }}" />
                        <x-input-error for="state.store_slogan" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="nombreComercial" :value="__('Nombre Comercial')" />
                        <x-input wire:model.defer="empresa.nombreComercial" type="text" id="nombreComercial"
                            class="block w-full mt-1 sm:text-sm"
                            placeholder="{{ __('Nombre comercial de la tienda') }}" />
                        <x-input-error for="empresa.nombreComercial" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="storeEmailInput" :value="__('Email de tu tienda')" />
                        <x-input wire:model.defer="state.store_contact_email" type="email" id="storeEmailInput"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('tienda@correo.com') }}" />
                        <x-input-error for="state.store_contact_email" class="mt-2" />
                    </div>

                    <div>
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

                    <div>
                        <x-input-label for="ciudad" :value="__('Ciudad')" />
                        <x-select wire:model="ciudad" class="block w-full mt-1 sm:text-sm">
                            <option value="">{{ __('Seleccione') }}</option>
                            @if ($listaCiudades)
                            @foreach ($listaCiudades as $ciudad)
                            <option value="{{ $ciudad->ciudad }}">{{ $ciudad->ciudad}}</option>
                            @endforeach
                            @endif

                        </x-select>
                        <x-input-error for="provincia" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="direccion" :value="__('Direccion')" />
                        <x-input wire:model.defer="empresa.direccion" type="text" id="direccion"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('Direccion') }}" />
                        <x-input-error for="empresa.direccion" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="storeContactPhoneInput" :value="__('Telefono de contacto')" />
                        <x-input wire:model.defer="state.store_contact_phone" type="text" id="storeContactPhoneInput"
                            class="block w-full mt-1 sm:text-sm" placeholder="{{ __('0912345678') }}" />
                        <x-input-error for="state.store_contact_phone" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contribuyenteEspecial" :value="__('Contribuyente Especial')" />
                        <x-input wire:model.='empresa.contribuyenteEspecial' type="checkbox" class="mr-2 !rounded" />
                    </div>

                    @if($empresa->contribuyenteEspecial)
                    <div>
                        <x-input-label for="numeroContribuyente" :value="__('Numero de contribuyente especial')" />
                        <x-input wire:model.defer="empresa.numeroContribuyente" type="text" id="numeroContribuyente"
                            class="block w-full mt-1 sm:text-sm"
                            placeholder="{{ __('Nombre comercial de la tienda') }}" />
                        <x-input-error for="empresa.numeroContribuyente" class="mt-2" />

                    </div>
                    @endif
                </div>
            </x-slot:content>

            <x-slot:footer>
                <button type="submit" class="block w-full btn btn-primary">
                    {{ __('Guardar y continuar') }}
                </button>
            </x-slot:footer>
        </x-card>
    </form>
</div>