<div>
    <form wire:submit='createPenyaluran' class="mt-6 space-y-6">
        <div>
            <x-input-label for="tanggal" :value="__('Tanggal')" />
            <x-text-input wire:model='tanggal' id="tanggal" type='date' class="block w-full mt-1" :value="old('tanggal')"
                required autocomplete="tanggal" />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal')" />
        </div>

        <div>
            <x-input-label for="uraian" :value="__('Uraian')" />
            <x-textarea-input x-autosize x-data wire:model='uraian' id='uraian' type='text'
                class="block w-full mt-1" :value="old('uraian')" required autocomplete="uraian" placeholder="Uraian" />
            <x-input-error class="mt-2" :messages="$errors->get('uraian')" />
        </div>

        <div>
            <x-input-label for="sumber_donasi_id" :value="__('Sumber Donasi')" />
            <x-select-input wire:model.change="selectedSumberDonasi" id="sumber_donasi" class="block w-full mt-1"
                required>
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

        <div>
            <x-input-label for="program_sumber_id" :value="__('Program Sumber')" />
            <x-select-input wire:model.change="selectedProgramSumber" id="program_sumber" class="block w-full mt-1"
                required>
                <option value="">{{ __('Select Program Sumber') }}</option>
                @foreach ($programSumbers as $programSumber)
                    <option value="{{ $programSumber->id }}"
                        {{ request('program_sumber_id') == 'program_sumber_id' ? 'selected' : '' }}>
                        {{ $programSumber->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('program_sumber_id')" />
        </div>

        <div>
            <x-input-label for="sumber_dana_id" :value="__('Sumber Dana')" />
            <x-select-input wire:model.change="selectedSumberDana" id="sumber_dana" class="block w-full mt-1" required>
                <option value="">{{ __('Select Sumber Dana') }}</option>
                @foreach ($sumberDanas as $sumberDana)
                    <option value="{{ $sumberDana->id }}"
                        {{ request('sumber_dana_id') == 'sumber_dana_id' ? 'selected' : '' }}>
                        {{ $sumberDana->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('sumber_dana_id')" />
        </div>

        <div>
            <p class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Saldo Saat Ini : {{ $currentSaldo ?? 'Select Sumber Dana' }}
            </p>
        </div>

        <div x-data="{ nominal: '' }">
            <x-input-label for="nominal" :value="__('Nominal')" />

            <x-text-input wire:model="nominal" id="nominal" type="text" class="block w-full mt-1" x-model="nominal" required
                x-on:input="nominal = 'Rp. ' + $event.target.value.replace(/[^,\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                placeholder="Rp." autocomplete="off" />

            <x-input-error class="mt-2" :messages="$errors->get('nominal')" />
        </div>

        <div>
            <x-input-label for="selectedPilar" :value="__('Pilar')" />
            <x-select-input wire:model.change="selectedPilar" id="pilar" class="block w-full mt-1">
                <option value="">{{ __('Select Pilar') }}</option>
                @foreach ($pilars as $pilar)
                    <option value="{{ $pilar->id }}">
                        {{ __('Pilar') }}
                        {{ $pilar->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('selectedPilar')" />
        </div>

        <div>
            <x-input-label for="selectedProgramPilar" :value="__('Program')" />
            <x-select-input wire:model.change="selectedProgramPilar" id="programPilar" class="block w-full mt-1"
                disabled="{{ $selectedPilar == null ? 'disabled' : '' }}">
                @if ($selectedPilar == null)
                    <option value="">{{ 'Please Select Pilar' }}</option>
                @else
                    <option value="" @if ($selectedProgramPilar == null) selected @endif>
                        {{ 'Select Program' }}
                    </option>
                    @foreach ($programPilars as $programPilar)
                        <option value="{{ $programPilar->id }}">
                            {{ __('Program') }} {{ $programPilar->name }}
                        </option>
                    @endforeach
                @endif
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('selectedProgramPilar')" />
        </div>

        <div>
            <x-input-label for="ashnaf_id" :value="__('Ashnaf')" />
            <x-select-input wire:model.change="selectedAshnaf" id="ashnaf" class="block w-full mt-1" required>
                <option value="">{{ __('Select Ashnaf') }}</option>
                @foreach ($ashnafs as $ashnaf)
                    <option value="{{ $ashnaf->id }}" {{ request('ashnaf_id') == 'ashnaf_id' ? 'selected' : '' }}>
                        {{ $ashnaf->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('ashnaf_id')" />
        </div>

        <div>
            <x-input-label for="lembaga" :value="__('Lembaga')" />
            <x-text-input wire:model='lembaga' id="lembaga" type="number" class="block w-full mt-1"
                :value="old('lembaga')" autocomplete="lembaga" min="0" placeholder="0" />
            <x-input-error class="mt-2" :messages="$errors->get('lembaga')" />
        </div>

        <div>
            <x-input-label for="pria" :value="__('Pria')" />
            <x-text-input wire:model='pria' id="pria" type="number" class="block w-full mt-1" :value="old('pria')"
                autocomplete="pria" min="0" placeholder="0" />
            <x-input-error class="mt-2" :messages="$errors->get('pria')" />
        </div>

        <div>
            <x-input-label for="wanita" :value="__('Wanita')" />
            <x-text-input wire:model='wanita' id="wanita" type="number" class="block w-full mt-1" :value="old('wanita')"
                autocomplete="wanita" min="0" placeholder="0" />
            <x-input-error class="mt-2" :messages="$errors->get('wanita')" />
        </div>

        <div>
            <x-input-label for="selectedProvinsi" :value="__('Provinsi/Luar Negeri')" />
            <x-select-input wire:model.change="selectedProvinsi" id="provinsi" class="block w-full mt-1" required>
                <option value="">{{ __('Select Provinsi/Luar Negeri') }}</option>
                @foreach ($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}">
                        {{ $provinsi->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('selectedProvinsi')" />
        </div>

        <div>
            <x-input-label for="selectedKabupaten" :value="__('Kabupaten/Negara')" />
            <x-select-input wire:model.change="selectedKabupaten" id="kabupaten" class="block w-full mt-1" required
                disabled="{{ $selectedProvinsi == null ? 'disabled' : '' }}">
                @if ($selectedProvinsi == null)
                    <option value="">{{ 'Please Select Provinsi/Luar Negeri' }}</option>
                @else
                    <option value="" @if ($selectedKabupaten == null) selected @endif>
                        {{ 'Select Kabupaten' }}
                    </option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}">
                            {{ $kabupaten->name }}
                        </option>
                    @endforeach
                @endif
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('selectedKabupaten')" />
        </div>

        <div>
            <x-input-label for="tahun_id" :value="__('Tahun')" />
            <x-select-input wire:model.change="selectedTahun" id="tahun" class="block w-full mt-1" required
                placeholder="Select Tahun">
                <option value="">{{ __('Select Tahun') }}</option>
                @foreach ($tahuns as $tahun)
                    <option value="{{ $tahun->id }}" {{ request('tahun_id') == 'tahun_id' ? 'selected' : '' }}>
                        {{ $tahun->name }}
                    </option>
                @endforeach
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('tahun_id')" />
        </div>

        <div>
            <x-input-label for="lampiran" :value="__('Lampirkan Link GDrive Bukti')" />
            <x-text-input id="lampiran" wire:model="lampiran" type="text" class="block w-full mt-1"
                :value="old('lampiran')" autocomplete="lampiran" />
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
            <x-button.primary type="submit">{{ __('Save') }}</x-button.primary>
        </div>
    </form>
</div>
