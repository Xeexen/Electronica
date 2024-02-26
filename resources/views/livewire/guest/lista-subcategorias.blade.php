<div>
    <x-slot:title>
        {{ $categoria->categoria }}
    </x-slot:title>

    <div class="border-b border-slate-200">
        <nav aria-label="Breadcrumb" class="px-4 mx-auto overflow-hidden max-w-7xl whitespace-nowrap sm:px-6 lg:px-8">
            <ol role="list" class="flex items-center py-4 space-x-4">
                <li>
                    <div class="flex items-center">
                        <a href="/" class="mr-4 text-sm font-medium text-slate-900">
                            Home
                        </a>
                        <svg viewBox="0 0 6 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            class="w-auto h-5 text-slate-300">
                            <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z" fill="currentColor" />
                        </svg>
                    </div>
                </li>
                <li class="text-sm truncate">
                    <a href="{{ route('guest.categorias.lista') }}" aria-current="page"
                        class="font-medium text-slate-500 hover:text-slate-600">
                        {{ $categoria->categoria }}
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <main class="max-w-2xl px-4 mx-auto lg:max-w-7xl lg:px-8">
        <div class="pt-24 pb-10 border-b border-slate-200">
            <h1 class="text-4xl font-bold tracking-tight text-slate-900">
                {{ __('Todas las Categorias') }}
            </h1>
        </div>

        <div class="pt-12 pb-24">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($subcategorias as $subcategoria)
                <div class="overflow-hidden rounded-lg group aspect-w-2 aspect-h-1 sm:relative sm:h-full">
                    <img src="{{ asset('storage/productos/'.$categoria->id. '/'.$subcategoria->id.'/subcategoria.jpg') }}"
                        alt="{{ $subcategoria->subcategoria }}"
                        class="object-cover object-center group-hover:opacity-75 sm:absolute sm:inset-0 sm:h-full sm:w-full">
                    <div aria-hidden="true"
                        class="opacity-50 bg-gradient-to-b from-transparent to-black sm:absolute sm:inset-0"></div>
                    <div class="flex items-end p-6 sm:absolute sm:inset-0">
                        <div>
                            <h3 class="text-lg font-semibold text-white">
                                <a
                                    href="{{ route('guest.articulos.lista', ['id' => $subcategoria->id, 'categoria' => $categoria->categoria, 'subcategoria' => $subcategoria->subcategoria]) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $subcategoria->subcategoria }}
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>