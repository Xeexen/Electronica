<div>
    <div>
        <form wire:submit.prevent="save">
            <x-card>
                <x-slot:header class="border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-base font-semibold leading-6 text-slate-900 dark:text-slate-200">
                        {{ __('Cuenta de Administrador') }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Crea una cuenta de administrador para tu tienda.') }}
                    </p>
                </x-slot:header>

                <x-slot:content>
                    <div class="space-y-6">
                        <div>
                            <x-input-label
                                for="adminNameInput"
                                :value="__('Nombre')"
                            />
                            <x-input
                                wire:model.defer="state.administrator_name"
                                type="text"
                                id="adminNameInput"
                                class="block w-full mt-1 sm:text-sm"
                                placeholder="{{ __('Tu nombre') }}"
                            />
                            <x-input-error
                                for="state.administrator_name"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="adminEmailInput"
                                :value="__('Email')"
                            />
                            <x-input
                                wire:model.defer="state.administrator_email"
                                type="email"
                                id="adminEmailInput"
                                class="block w-full mt-1 sm:text-sm"
                                placeholder="{{ __('ejemplo@ejemplo.com') }}"
                            />
                            <x-input-error
                                for="state.administrator_email"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="adminPasswordInput"
                                :value="__('Contraseña')"
                            />
                            <x-input
                                wire:model.defer="state.administrator_password"
                                type="password"
                                id="adminPasswordInput"
                                class="block w-full mt-1 sm:text-sm"
                                placeholder="{{ __('********') }}"
                            />
                            <x-input-error
                                for="state.administrator_password"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label
                                for="adminPasswordConfirmationInput"
                                :value="__('Confirmar Contraseña')"
                            />
                            <x-input
                                wire:model.defer="state.administrator_password_confirmation"
                                type="password"
                                id="adminPasswordConfirmationInput"
                                class="block w-full mt-1 sm:text-sm"
                                placeholder="{{ __('********') }}"
                            />
                            <x-input-error
                                for="state.administrator_password_confirmation"
                                class="mt-2"
                            />
                        </div>
                    </div>
                </x-slot:content>

                <x-slot:footer>
                    <button
                        type="submit"
                        class="block w-full btn btn-primary"
                    >
                        {{ __('Guardar y Continuar') }}
                    </button>
                </x-slot:footer>
            </x-card>
        </form>
    </div>

</div>
