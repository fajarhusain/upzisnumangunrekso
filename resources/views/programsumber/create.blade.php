<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Program Sumber') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Program Sumber Dana') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Program Sumber Dana.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('programsumber.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="sumber_donasi_id" :value="__('Sumber Donasi')" />
                            <x-select-input id="sumber_donasi" name="sumber_donasi_id" class="block w-full mt-1" required>
                                <option value="">{{ __('Select Sumber Donasi') }}</option>
                                @foreach ($sumberDonasis as $sumberDonasi)
                                    <option value="{{ $sumberDonasi->id }}"
                                        {{ request('sumber_donasi_id') == 'sumber_donasi_id' ? 'selected' : '' }}>
                                        {{ $sumberDonasi->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('sumber_donasi_id')" />
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
