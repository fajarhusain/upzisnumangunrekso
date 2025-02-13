<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Pilar') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Pilar') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Pilar.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('pilar.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="pilar" :value="__('Pilar')" />
                            <x-text-input id="pilar" name="pilar" type="text" class="block w-full mt-1"
                                :value="old('pilar')" required autofocus autocomplete="pilar" />
                            <x-input-error class="mt-2" :messages="$errors->get('pilar')" />
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
