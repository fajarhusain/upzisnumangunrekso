<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Data Tahun') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Edit Data Tahun') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Edit Data Tahun yang sudah ada.') }}
                </x-card.description>
                <div class="max-w-xl">
                    {{-- @dump($tahun) --}}
                    <form method="post" action="{{ route('tahun.update', $tahun) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div x-data="{ tahun: '{{ $tahun->name }}' }">
                            <x-input-label for="tahun" :value="__('Tahun')" />

                            <x-text-input id="tahun" name="tahun" type="text" class="block w-full mt-1" required
                                x-model="tahun" x-on:input="tahun = $event.target.value.replace(/[^0-9]/g, '')"
                                autocomplete="tahun" placeholder="Masukkan hanya angka" />

                            <x-input-error class="mt-2" :messages="$errors->get('tahun')" />
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
