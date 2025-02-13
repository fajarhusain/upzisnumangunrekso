<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Sumber Dana') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="flex">
                    <x-card.title>
                        {{ __('Semua Daftar Sumber Dana') }}
                    </x-card.title>
                    <div class="ml-auto">
                        <x-button.link-primary href="{{ route('sumberdana.create') }}">
                            {{ __('Create') }}
                        </x-button.link-primary>
                    </div>
                </div>
                <x-card.description>
                    {{ __('Mengatur Seluruh Daftar Sumber Dana.') }}
                </x-card.description>

                @include('sumberdana.partials.table')

            </x-card.app>
        </div>
    </div>
</x-app-layout>
