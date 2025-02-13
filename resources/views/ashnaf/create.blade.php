<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __(' Create Data Ashnaf') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Ashnaf') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Ashnaf.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('ashnaf.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="ashnaf" :value="__('Ashnaf')" />
                            <x-text-input id="ashnaf" name="ashnaf" type="text" class="block w-full mt-1"
                                :value="old('ashnaf')" required autofocus autocomplete="ashnaf"/>
                            <x-input-error class="mt-2" :messages="$errors->get('ashnaf')" />
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
