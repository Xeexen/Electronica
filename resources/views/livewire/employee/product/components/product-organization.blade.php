<div
    x-data="{ dirty: false, original: @json($selectedCollections), selected: @json($selectedCollections) }"
    x-init="$watch('selected', () => dirty = selected.sort().toString() !== original.sort().toString())"
    x-on:saved.window="dirty = false; original = selected"
>
    <x-card class="overflow-hidden">
        <x-slot:header>
            <div class="flex flex-wrap items-center justify-between -mt-2 -ml-4 sm:flex-nowrap">
                <div class="mt-2 ml-4">
                    <h3 class="text-base font-medium text-slate-900 dark:text-slate-200">
                        {{ __('Collection') }}
                    </h3>
                </div>
                <div
                    x-show="dirty"
                    class="flex-shrink-0 mt-2 ml-4"
                >
                    <button
                        wire:target="save"
                        wire:loading.delay.attr="disabled"
                        wire:click.prevent="save"
                        class="btn btn-link"
                    >
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </x-slot:header>
        <x-slot:content class="-mt-5">
            <div class="-mx-4 -mb-5 overflow-y-auto border-t border-slate-300 max-h-72 sm:-mx-6 dark:border-slate-200/20">
                @if($this->collections->count())
                    <ul class="divide-y divide-slate-200 dark:divide-slate-200/10">
                        @foreach($this->collections as $collection)
                            <div class="relative flex items-start p-4 sm:px-6 hover:bg-slate-50 dark:hover:bg-slate-800">
                                <span
                                    onclick="event.preventDefault(); document.querySelector('#collection-{{ $collection->id }}').click()"
                                    class="absolute inset-0 cursor-pointer"
                                ></span>
                                <div class="flex-1 min-w-0 text-sm">
                                    <x-input-label
                                        for="collection-{{ $collection->id }}"
                                        :value="$collection->title"
                                    />
                                </div>
                                <div class="flex items-center h-5 ml-3">
                                    <x-input
                                        x-model.number="selected"
                                        wire:model.defer="selectedCollections"
                                        id="collection-{{ $collection->id }}"
                                        type="checkbox"
                                        value="{{ $collection->id }}"
                                        class="h-4 w-4 !rounded !shadow-none"
                                    />
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p class="my-6 text-sm text-center">
                        {{ __('No collections available.') }}
                    </p>
                @endif
            </div>
        </x-slot:content>
    </x-card>
</div>
