<div>
    <!-- Meta title & description -->
    <x-slot:title>
        {{ __('Ordenes') }}
    </x-slot:title>

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
            <div class="max-w-2xl px-4 mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    {{ __('Tus ordenes!') }}
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    {{ __('Mira el detalle de tus ordenes') }}
                </p>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="sr-only">{{ __('Ordenes Recientes') }}</h2>
            <div class="mx-auto max-w-7xl sm:px-2 lg:px-8">
                <div class="max-w-2xl mx-auto space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
                    @if ($ordenes)
                    @foreach($ordenes as $orden)
                    <div class="bg-white border-t border-b shadow-sm border-slate-200 sm:rounded-lg sm:border">
                        <h2 class="sr-only">
                            {{ __('Creado el') }}
                            <time datetime="{{ $orden->created_at->format('Y-m-d') }}">{{
                                $orden->created_at->toFormattedDateString() }}</time>
                        </h2>

                        <div
                            class="flex items-center p-4 border-b border-slate-200 sm:grid sm:grid-cols-4 sm:gap-x-6 sm:p-6">
                            <dl
                                class="grid flex-1 grid-cols-2 text-sm gap-x-6 sm:col-span-3 sm:grid-cols-3 lg:col-span-2">
                                <div>
                                    <dt class="font-medium text-slate-900">
                                        {{ __('Numero de Orden') }}
                                    </dt>
                                    <dd class="mt-1 text-slate-500">
                                        {{ $orden->numero }}
                                    </dd>
                                </div>
                                <div class="hidden sm:block">
                                    <dt class="font-medium text-slate-900">
                                        {{ __('Fecha de Creacion') }}
                                    </dt>
                                    <dd class="mt-1 text-slate-500">
                                        <time datetime="{{ $orden->created_at->format('Y-m-d') }}">{{
                                            $orden->created_at->toFormattedDateString() }}</time>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-slate-900">{{ __('Total Orden') }}</dt>
                                    <dd class="mt-1 font-medium text-slate-900">
                                        <x-money :amount="$orden->total" :currency="config('app.currency')" />
                                    </dd>
                                </div>
                            </dl>

                            <div class="relative flex justify-end lg:hidden">
                                <x-dropdown>
                                    <x-slot:trigger>
                                        <button type="button"
                                            class="flex items-center p-2 -m-2 text-slate-400 hover:text-slate-500"
                                            id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                                        </button>
                                    </x-slot:trigger>
                                    <x-slot:content>
                                        <x-dropdown-link href="{{ route('customer.orders.detail', $orden) }}">
                                            {{ __('Ver') }}
                                        </x-dropdown-link>
                                    </x-slot:content>
                                </x-dropdown>
                            </div>

                            {{-- <div class="hidden lg:col-span-2 lg:flex lg:items-center lg:justify-end lg:space-x-4">
                                <a href="" class="btn btn-outline-primary">
                                    <span>{{ __('View Order') }}</span>
                                    <span class="sr-only">{{ $orden->id }}</span>
                                </a>
                            </div> --}}
                        </div>

                        <!-- Products -->
                        <h3 class="sr-only">
                            {{ __('Items') }}
                        </h3>
                    </div>
                    @endforeach
                    @endif

                    <div class="mt-8">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>