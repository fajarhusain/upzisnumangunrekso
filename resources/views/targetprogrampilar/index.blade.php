<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Target Program') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="flex">
                    <x-card.title>
                        {{ __('Semua daftar Target Program') }}
                    </x-card.title>
                    <div class="ml-auto">
                        <x-button.link-primary href="{{ route('targetprogrampilar.create') }}">
                            {{ __('Create') }}
                        </x-button.link-primary>
                    </div>
                </div>

                @include('targetprogrampilar.partials.table')

            </x-card.app>
        </div>
    </div>
</x-app-layout>
