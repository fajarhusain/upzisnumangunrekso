<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Data Target Tahunan') }}
        </h2>
    </x-slot>

    <div class="sm:py-6">
        <div class="max-w-full mx-auto sm:px-6 sm:space-y-6">
            <x-card.app>
                <x-card.title>
                    {{ __('Create Data Target Tahunan') }}
                </x-card.title>
                <x-card.description>
                    {{ __('Create a new Data Target Tahunan.') }}
                </x-card.description>
                <div class="max-w-xl">
                    <form method="post" action="{{ route('targettahunan.update', $targettahunan) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="jenis" :value="__('Jenis Target')" />
                            <x-select-input id="jenis" name="jenis" class="block w-full mt-1">
                                <option value="">{{ __('Pilih Target') }}</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->value }}"
                                        {{ $targettahunan->jenis == $type->value ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis')" />
                        </div>

                        <div x-data="{
                            nominal: '{{ $targettahunan->nominal }}',
                            formattedNominal: ''
                        }" x-init="// Format the initial value of nominal on page load
                        formattedNominal = 'Rp. ' + (nominal || '').replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
                            <x-input-label for="nominal" :value="__('Nominal')" />

                            <x-text-input id="formatted_nominal" name="nominal" type="text" class="block w-full mt-1"
                                x-model="formattedNominal"
                                x-on:input="
                                // Format the displayed nominal with 'Rp.' and thousands separators
                                formattedNominal = 'Rp. ' + $event.target.value.replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                                // Update the hidden nominal field with an integer-only value
                                nominal = $event.target.value.replace(/[^0-9]/g, '');
                            "
                                placeholder="Rp." autocomplete="off" />

                            <!-- Hidden input to send the integer value -->
                            <input type="hidden" name="nominal" :value="nominal">

                            <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tahun_id" :value="__('Tahun')" />
                            <x-select-input id="tahun" name="tahun_id" class="block w-full mt-1">
                                <option value="">{{ __('Select Tahun') }}</option>
                                @foreach ($tahuns as $tahun)
                                    <option value="{{ $tahun->id }}"
                                        {{ $tahun->id == $targettahunan->tahun->id ? 'selected' : '' }}>
                                        {{ $tahun->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('tahun_id')" />
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
