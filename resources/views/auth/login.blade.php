<x-guest-layout>
    <div class="py-32">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="text-3xl font-bold tracking-tight text-center text-slate-900">
                {{ __('Ingresa a tu cuenta') }}
            </h1>
            <p class="mt-2 text-sm text-center text-slate-600">
                {{ __('O') }}
                <a href="{{ route('register') }}" class="btn btn-link">
                    {{ __('crea una nueva para empezar!') }}
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <x-card>
                <x-slot:content class="!py-8 sm:!px-10">
                    <!-- Session Status -->
                    @if(session('status'))
                    <x-alert class="mb-6" type="success" message="{{ session('status') }}" />
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block w-full mt-1 sm:text-sm" type="email" name="email"
                                :value="old('email')" required autofocus />

                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-6">
                            <x-input-label for="password" :value="__('Contraseña')" />

                            <x-input id="password" class="block w-full mt-1 sm:text-sm" type="password" name="password"
                                required autocomplete="current-password" />

                            <x-input-error for="password" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <x-input type="checkbox" name="remember_me" id="remember_me"
                                    class="h-4 w-4 !rounded !shadow-none" />

                                <x-input-label for="remember_me" :value="__('Recuerdame')" class="ml-2" />
                            </div>
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="btn btn-link">
                                    {{ __('Olvidaste tu contraseña?') }}
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button class="w-full btn btn-primary">
                                {{ __('Ingresar') }}
                            </button>
                        </div>
                    </form>
                </x-slot:content>
            </x-card>
        </div>
    </div>
</x-guest-layout>