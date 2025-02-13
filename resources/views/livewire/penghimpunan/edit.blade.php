<form wire:submit='updatePenghimpunan' class="mt-6 space-y-6">
    <div>
        <x-input-label for="tanggal" :value="__('Tanggal')" />
        <x-text-input id="tanggal" wire:model="tanggal" type="date" class="block w-full mt-1" :value="old('tanggal')"
            required autocomplete="tanggal" />
        <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
    </div>

    <div>
        <x-input-label for="uraian" :value="__('Uraian')" />
        <x-textarea-input x-data x-autosize id="uraian" wire:model="uraian" type="text" class="block w-full mt-1"
            required autocomplete="uraian">
            {{ old('uraian') }}
        </x-textarea-input>
        <x-input-error class="mt-2" :messages="$errors->get('uraian')" />
    </div>

    <div x-data="{
        nominal: '{{ $nominal }}',
        formattedNominal: ''
    }" x-init="// Format the initial value of nominal on page load
    formattedNominal = 'Rp. ' + (nominal || '').replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');">
        <x-input-label for="nominal" :value="__('Nominal')" />

        <x-text-input id="formatted_nominal" wire:model="nominal" type="text" class="block w-full mt-1"
            x-model="formattedNominal"
            x-on:input="
            // Format the displayed nominal with 'Rp.' and thousands separators
            formattedNominal = 'Rp. ' + $event.target.value.replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Update the hidden nominal field with an integer-only value
            nominal = $event.target.value.replace(/[^0-9]/g, '');
        "
            placeholder="Rp." autocomplete="off" />

        <!-- Hidden input to send the integer value -->
        <input type="hidden" wire:model="nominal" :value="nominal">

        <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
    </div>

    <div>
        <x-input-label for="lembaga" :value="__('Jumlah Lembaga')" />
        <x-text-input id="lembaga" wire:model="lembaga" type="number" class="block w-full mt-1" :value="old('lembaga')"
            autocomplete="lembaga" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('lembaga')" />
    </div>

    <div>
        <x-input-label for="pria" :value="__('Jumlah Pria')" />
        <x-text-input id="pria" wire:model="pria" type="number" class="block w-full mt-1" :value="old('pria')"
            autocomplete="pria" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('pria')" />
    </div>

    <div>
        <x-input-label for="wanita" :value="__('jumlah Wanita')" />
        <x-text-input id="wanita" wire:model="wanita" type="number" class="block w-full mt-1" :value="old('wanita')"
            autocomplete="wanita" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('wanita')" />
    </div>

    <div>
        <x-input-label for="noname" :value="__('jumlah No Name')" />
        <x-text-input id="noname" wire:model="noname" type="number" class="block w-full mt-1" :value="old('noname')"
            autocomplete="noname" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('noname')" />
    </div>

    <div>
        <x-input-label for="sumber_donasi_id" :value="__('Sumber Donasi')" />
        <x-select-input wire:model.change="selectedSumberDonasi" id="sumber_donasi" class="block w-full mt-1">
            <option value="">{{ __('Select Sumber Donasi') }}</option>
            @foreach ($sumberDonasis as $sumberDonasi)
                <option value="{{ $sumberDonasi->id }}"
                    {{ request('sumber_donasi_id') == 'sumber_donasi_id' ? 'selected' : '' }}>
                    {{ $sumberDonasi->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('selectedSumberDonasi')" />
    </div>

    <div>
        <x-input-label for="program_sumber_id" :value="__('Program Sumber')" />
        <x-select-input wire:model.change="selectedProgramSumber" id="program_sumber" class="block w-full mt-1"
            disabled="{{ $selectedSumberDonasi == null ? 'disabled' : '' }}">
            @if ($selectedSumberDonasi == null)
                <option value="">{{ 'Please Select Sumber Donasi' }}</option>
            @else
                <option value="" @if ($selectedProgramSumber == null) selected @endif>
                    {{ __('Select Program Sumber') }}</option>
                @foreach ($programSumbers as $programSumber)
                    <option value="{{ $programSumber->id }}"
                        {{ request('program_sumber_id') == 'program_sumber_id' ? 'selected' : '' }}>
                        {{ $programSumber->name }}
                    </option>
                @endforeach
            @endif
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('selectedProgramSumber')" />
    </div>

    <div>
        <x-input-label for="sumber_dana_id" :value="__('Sumber Dana')" />
        <x-select-input id="sumber_dana" wire:model.change="selectedSumberDana" class="block w-full mt-1">
            <option value="">{{ __('Select Sumber Dana') }}</option>
            @foreach ($sumberDanas as $sumberDana)
                <option value="{{ $sumberDana->id }}"
                    {{ request('sumber_dana_id') == 'sumber_dana_id' ? 'selected' : '' }}>
                    {{ $sumberDana->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('selectedSumberDana')" />
    </div>

    <div>
        <x-input-label for="tahun_id" :value="__('Tahun')" />
        <x-select-input id="tahun" wire:model.change="selectedTahun" class="block w-full mt-1">
            <option value="">{{ __('Select Tahun') }}</option>
            @foreach ($tahuns as $tahun)
                <option value="{{ $tahun->id }}" {{ request('tahun_id') == 'tahun_id' ? 'selected' : '' }}>
                    {{ $tahun->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-input-error class="mt-2" :messages="$errors->get('selectedTahun')" />
    </div>

    <div>
        <x-input-label for="lampiran" :value="__('Lampirkan Link GDrive Bukti')" />
        <x-text-input id="lampiran" wire:model="lampiran" type="text" class="block w-full mt-1" :value="old('lampiran')"
            autocomplete="lampiran" />
        <x-input-error class="mt-2" :messages="$errors->get('lampiran')" />
    </div>

    <div class="block mt-4">
        <label for="pindah_dana" class="inline-flex items-center">
            <input id="pindah_dana" type="checkbox"
                class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                wire:model="isPindahDana">
            <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Pindah Dana') }}</span>
        </label>
    </div>

    <div class="flex items-center gap-4">
        <x-button.primary>{{ __('Save') }}</x-button.primary>
    </div>
</form>
