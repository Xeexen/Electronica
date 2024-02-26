<div>
    @unless($completed)
    <form wire:submit.prevent="save">
        <x-card>
            <x-slot:header class="border-b border-slate-200 dark:border-white/10">
                <h3 class="text-base font-semibold leading-6 text-slate-900 dark:text-slate-200">
                    {{ __('Verifica tu informacion') }}
                </h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Porfavor verifica tu informacion antes de comenzar.') }}
                </p>
            </x-slot:header>

            <x-slot:content>
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Nombre de la tienda') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->store_information_state['store_name'] }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Slogan') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->store_information_state['store_slogan'] }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Email de contacto') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->store_information_state['store_contact_email'] ?: __('*Not provided*') }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Telefono de contacto') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->store_information_state['store_contact_phone'] ?: __('*Not provided*') }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Nombre del Administrador') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->administrator_account_state['administrator_name'] }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Administrator email') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ $this->administrator_account_state['administrator_email'] }}
                        </dd>
                    </div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">
                            {{ __('Administrator password') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            {{ __('*Hidden*') }}
                        </dd>
                    </div>
                </dl>
            </x-slot:content>

            <x-slot:footer>
                <button type="submit" class="block w-full btn btn-primary">
                    {{ __('Finish setup') }}
                </button>
            </x-slot:footer>
        </x-card>
    </form>
    @else
    <x-card>
        <x-slot:content>
            <div class="text-center">
                <span class="text-3xl">
                    🎉
                </span>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">
                    {{ __('Felicidades!') }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ __("Su tienda se ha configurado correctamente. Ahora puedes iniciar sesión en el panel de
                    administración de tu tienda y comenzar a vender tus productos.") }}
                </p>
                <div class="mt-6">
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-primary">
                        {{ __('Ir al panel de administracion') }}
                    </a>
                </div>
            </div>
        </x-slot:content>
    </x-card>
    @endunless
</div>