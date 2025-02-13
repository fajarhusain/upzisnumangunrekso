<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Program Sumber') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="flex">
                    <x-card.title>
                        {{ __('All Data Program Sumber') }}
                    </x-card.title>
                    <div class="ml-auto">
                        <x-button.link-primary href="{{ route('programsumber.create') }}">
                            {{ __('Create') }}
                        </x-button.link-primary>
                    </div>
                </div>

                <x-card.description>
                    {{ __('Manage all Program Sumber.') }}
                </x-card.description>

                @include('programsumber.partials.table')

            </x-card.app>
        </div>
    </div>
</x-app-layout>
