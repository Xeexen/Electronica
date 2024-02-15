<div class="flex flex-col justify-center w-full h-full">
    <div class="w-full max-w-2xl px-4 py-24 mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-center max-w-lg mx-auto">
            <h1 class="text-3xl font-medium text-slate-900 dark:text-white">
                {{ __('Configurando tu tienda') }}
            </h1>
            <p class="mt-2 text-center text-slate-500 dark:text-slate-400">
                {{ __('Completa los pasos para empezar!') }}
            </p>
        </div>
        <div class="mt-10">
            <livewire:setup.wizard />
        </div>
    </div>
</div>
