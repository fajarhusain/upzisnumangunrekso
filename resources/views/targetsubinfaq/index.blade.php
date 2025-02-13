<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Target sub-Infaq') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="flex">
                    <x-card.title>
                        {{ __('Semua Daftar Target sub-Infaq') }}
                    </x-card.title>
                    <div class="ml-auto">
                        <x-button.link-primary href="{{ route('targetsubinfaq.create') }}">
                            {{ __('Create') }}
                        </x-button.link-primary>
                    </div>
                </div>
                <x-card.description>
                    {{ __('Mengatur Seluruh Daftar Target sub-Infaq.') }}
                </x-card.description>

                @include('targetsubinfaq.partials.table')

            </x-card.app>
        </div>
    </div>
</x-app-layout>
