<form class="mt-6 space-y-6" wire:submit='createPenghimpunan' {{-- method="post" action="{{ route('penghimpunan.store') }}"  x-data="{
    today: new Date().toISOString().split('T')[0],
    selectedYear: '',
    updateYear() {
        // Extract the year from the 'tanggal' input value
        this.selectedYear = new Date(this.today).getFullYear();
    }
}"
    x-init="updateYear()" --}}>
    {{-- @csrf
    @method('post') --}}
    <div>
        <x-input-label for="tanggal" :value="__('Tanggal')" />
        <x-text-input id="tanggal" wire:model="tanggal" type="date" class="block w-full mt-1" :value="old('tanggal')"
            required autocomplete="tanggal" {{-- x-model="today" @change="updateYear" --}} />
        <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
    </div>

    <div>
        <x-input-label for="uraian" :value="__('Uraian')" />
        <x-textarea-input x-data x-autosize id="uraian" wire:model="uraian" type="text" class="block w-full mt-1"
            :value="old('uraian')" required autocomplete="uraian" />
        <x-input-error class="mt-2" :messages="$errors->get('uraian')" />
    </div>

    <div x-data="{ nominal: '' }">
        <x-input-label for="nominal" :value="__('Nominal')" />

        <x-text-input id="nominal" wire:model="nominal" type="text" class="block w-full mt-1" x-model="nominal"
            x-on:input="nominal = 'Rp. ' + $event.target.value.replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
            placeholder="Rp." autocomplete="off" />

        <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
    </div>


    <div>
        <x-input-label for="lembaga" :value="__('Jumlah Lembaga')" />
        <x-text-input id="lembaga" wire:model.lazy="lembaga" type="number" class="block w-full mt-1"
            :value="old('lembaga')" autocomplete="lembaga" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('lembaga')" />
    </div>
    {{-- @dump($lembaga) --}}
    <div>
        <x-input-label for="pria" :value="__('Jumlah Pria')" />
        <x-text-input id="pria" wire:model.lazy="pria" type="number" class="block w-full mt-1" :value="old('pria')"
            autocomplete="pria" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('pria')" />
    </div>
    {{-- @dump($pria) --}}
    <div>
        <x-input-label for="wanita" :value="__('Jumlah Wanita')" />
        <x-text-input id="wanita" wire:model="wanita" type="number" class="block w-full mt-1" :value="old('wanita')"
            autocomplete="wanita" min="0" placeholder="0" />
        <x-input-error class="mt-2" :messages="$errors->get('wanita')" />
    </div>

    <div>
        <x-input-label for="noname" :value="__('Jumlah No Name')" />
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
        <x-select-input wire:model.change="selectedSumberDana" id="sumber_dana" class="block w-full mt-1">
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

    <div class="mt-4">
        <x-input-label for="tahun_id" :value="__('Tahun')" />
        <x-select-input wire:model.change="selectedTahun" id="tahun" class="block w-full mt-1">
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
