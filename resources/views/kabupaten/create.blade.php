<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Kabupaten/Negara') }}
        </h2>
    </x-slot>

    <div class="sm:py-7">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Kabupaten/Negara') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Kabupaten/Negara.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('kabupaten.store') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')
                        <div>
                            <x-input-label for="provinsi_id" :value="__('Provinsi/Luar Negeri')" />
                            <x-select-input id="provinsi" name="provinsi_id" class="block w-full mt-1" autofocus>
                                <option value="">{{ __('Select Provinsi/Luar Negeri') }}</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}"
                                        {{ request('provinsi_id') == 'provinsi_id' ? 'selected' : '' }}>
                                        {{ $provinsi->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('pilar_id')" />
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                                :value="old('name')" required autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
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
