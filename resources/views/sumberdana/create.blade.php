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
                    <form method="post" action="{{ route('sumberdana.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="name" :value="__('Name Sumber Dana')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div x-data>
                            <x-input-label for="norek" :value="__('Nomor Rekening')" />
                            <x-text-input id="norek" name="norek" type="text" class="block w-full mt-1"
                                :value="old('norek')" autocomplete="norek"
                                x-on:input="event.target.value = event.target.value.replace(/[^0-9]/g, '')" />
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
