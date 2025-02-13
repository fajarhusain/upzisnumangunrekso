<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Kabupaten/Negara') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <div class="flex">
                    <x-card.title>
                        {{ __('Semua daftar Kabupaten/Negara') }}
                    </x-card.title>
                    <div class="ml-auto">
                        <x-button.link-primary href="{{ route('kabupaten.create') }}">
                            {{ __('Create') }}
                        </x-button.link-primary>
                    </div>
                </div>
                @if (request('search') || request('role') || request('verified_account'))
                    <x-card.description>
                        {{ __('Filter for') }}
                        @if (request('search'))
                            <span class="font-semibold">{{ request('search') }}</span>
                        @endif
                        @if (request('role'))
                            {{ __('role') }} <span class="font-semibold">{{ request('role') }}</span>
                        @endif
                        @if (request('verified_account'))
                            {{ __('status') }} <span class="font-semibold">
                                @if (request('verified_account') == 'true')
                                    {{ __('verified') }}
                                @else
                                    {{ __('not verified') }}
                                @endif
                            </span>
                        @endif
                    </x-card.description>
                @else
                @endif
                <x-card.description>
                    {{ __('Mengatur Seluruh Daftar Kabupaten/Negara.') }}
                </x-card.description>
                @if ($errors->any())
                    <div>
                        <ul class="mt-3 text-sm text-red-600 list-none dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('kabupaten.partials.table')

                <div class="mt-6">
                    {{ $kabupatens->links() }}
                </div>
            </x-card.app>
        </div>
    </div>
</x-app-layout>
