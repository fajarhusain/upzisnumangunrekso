<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Sumber Dana') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Sumber Dana') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Sumber Dana.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('sumberdana.update', $sumberdana) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name', $sumberdana->name)" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div x-data="{ norek: '{{ $sumberdana->rekening_sumda }}' }">
                            <x-input-label for="norek" :value="__('Nomor Rekening')" />

                            <x-text-input id="norek" name="norek" type="text" class="block w-full mt-1"
                                x-model="norek" x-on:input="norek = $event.target.value.replace(/[^0-9]/g, '')"
                                autocomplete="norek" placeholder="Masukkan hanya angka" />

                            <x-input-error class="mt-2" :messages="$errors->get('norek')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-button.primary>{{ __('Save') }}</x-button.primary>
                        </div>
                    </form>
                </div>
            </x-card.app>
        </div>
    </div>
</x-app-layout>
