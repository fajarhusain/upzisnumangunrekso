<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Penyaluran') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Penyaluran') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Penyaluran.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <livewire:penyaluran.create>
                </div>
            </x-card.app>
        </div>
    </div>
</x-app-layout>
