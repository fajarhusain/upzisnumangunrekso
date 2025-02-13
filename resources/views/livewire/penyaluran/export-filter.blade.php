<x-card.app>
    <div class="justify-between w-full md:flex">
        <x-card.title>
            {{ __('Export Data Penyaluran') }}
        </x-card.title>
        <div class="flex justify-end gap-2">
            <div class="ml-auto">
                <x-button.link-primary href="{{ route('penyaluran.index') }}">
                    {{ __('Cancel') }}
                </x-button.link-primary>
            </div>
            <div class="ml-auto">
                <x-primary-button wire:click="exportExel">
                    {{ __('Export Exel') }}
                </x-primary-button>
            </div>
            <div class="ml-auto" wire:click="exportCsv">
                <x-primary-button>
                    {{ __('Export CSV') }}
                </x-primary-button>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-end gap-2 mt-2 sm:mt-4">
        <div class="flex items-center gap-2">
            <x-input-label for="tanggal" :value="__('Tanggal Awal')" />
            <x-text-input wire:model.lazy='dateStart' id="tanggal" type='date' class="block w-full"
                :value="old('tanggal')" />
        </div>
        <div class="flex items-center gap-2 ">
            <x-input-label for="tanggal" :value="__('Tanggal Akhir')" />
            <x-text-input wire:model.lazy='dateEnd' id="tanggal" type='date' class="block w-full"
                :value="old('tanggal')" />
        </div>
        <x-select-input id="tahun" wire:model.lazy="selectedTahun" class="">
            <option value="">{{ __('Tahun') }}</option>
            @foreach ($tahuns as $tahun)
                <option value="{{ $tahun->id }}">
                    {{ $tahun->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input id="bulan" wire:model.lazy="selectedBulan" class="">
            <option value="">{{ __('Bulan') }}</option>
            <option value="1">
                Januari
            </option>
            <option value="2">
                Februari
            </option>
            <option value="3">
                Maret
            </option>
            <option value="4">
                April
            </option>
            <option value="5">
                Mei
            </option>
            <option value="6">
                Juni
            </option>
            <option value="7">
                Juli
            </option>
            <option value="8">
                Agustus
            </option>
            <option value="9">
                September
            </option>
            <option value="10">
                Oktober
            </option>
            <option value="11">
                November
            </option>
            <option value="12">
                Desember
            </option>
        </x-select-input>
        <x-select-input id="sumber_donasi" wire:model.lazy="selectedSumberDonasi" class="">
            <option value="">{{ __('Sumber Donasi') }}</option>
            @foreach ($sumberDonasis as $sumberDonasi)
                <option value="{{ $sumberDonasi->id }}">
                    {{ $sumberDonasi->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input id="program_sumber" wire:model.lazy="selectedProgramSumber" class="">
            <option value="">{{ __('Program Sumber') }}</option>
            @foreach ($programSumbers as $programSumber)
                <option value="{{ $programSumber->id }}">
                    {{ $programSumber->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input wire:model.lazy="selectedSumberDana" id="sumber_dana" class="">
            <option value="">{{ __('Sumber Dana') }}</option>
            @foreach ($sumberDanas as $sumberDana)
                <option value="{{ $sumberDana->id }}">
                    {{ $sumberDana->name }}
                </option>
            @endforeach
        </x-select-input>

        <x-select-input wire:model.lazy="selectedProvinsi" id="provinsi" class="">
            <option value="">{{ __('Provinsi') }}</option>
            @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}">
                    {{ $provinsi->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input wire:model.lazy="selectedKabupaten" id="kabupaten" class="">
            <option value="">{{ __('Kabupaten') }}</option>
            @foreach ($kabupatens as $kabupaten)
                <option value="{{ $kabupaten->id }}">
                    {{ $kabupaten->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input wire:model.lazy="selectedAshnaf" id="ashnaf" class="">
            <option value="">{{ __('Ashnaf') }}</option>
            @foreach ($ashnafs as $ashnaf)
                <option value="{{ $ashnaf->id }}">
                    {{ $ashnaf->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input wire:model.lazy="selectedPilar" id="pilar" class="">
            <option value="">{{ __('Pilar') }}</option>
            @foreach ($pilars as $pilar)
                <option value="{{ $pilar->id }}">
                    {{ $pilar->name }}
                </option>
            @endforeach
        </x-select-input>
        <x-select-input wire:model.lazy="selectedProgramPilar" id="program_pilar" class="">
            <option value="">{{ __('Program Pilar') }}</option>
            @foreach ($programPilars as $programPilar)
                <option value="{{ $programPilar->id }}">
                    {{ $programPilar->name }}
                </option>
            @endforeach
        </x-select-input>
    </div>
    <div class="relative mt-6 overflow-auto rounded-md">
        <table class="w-full text-base text-left text-gray-500 table-fixed dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="w-10 p-0 text-center">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="p-0 text-center w-36 whitespace-nowrap">
                        {{ __('Tanggal') }}
                    </th>
                    <th scope="col" class="p-0 text-center w-36 whitespace-nowrap">
                        {{ __('Uraian') }}
                    </th>
                    <th scope="col" class="w-32 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Sumber Donasi') }}
                    </th>
                    <th scope="col" class="w-64 p-0 px-4 lg:table-cell whitespace-nowrap">
                        {{ __('Program Sumber') }}
                    </th>
                    <th scope="col" class="w-40 p-0 px-4 lg:table-cell whitespace-nowrap">
                        {{ __('Sumber Dana') }}
                    </th>
                    <th scope="col" class="w-48 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Nominal') }}
                    </th>
                    <th scope="col" class="w-32 p-0 px-3 lg:table-cell whitespace-nowrap">
                        {{ __('Pilar') }}
                    </th>
                    <th scope="col" class="w-64 p-0 px-4 lg:table-cell whitespace-nowrap">
                        {{ __('Program') }}
                    </th>
                    <th scope="col" class="w-24 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Ashnaf') }}
                    </th>
                    <th scope="col" class="w-24 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Lembaga') }}
                    </th>
                    <th scope="col" class="w-24 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Pria') }}
                    </th>
                    <th scope="col" class="w-24 p-0 text-center lg:table-cell whitespace-nowrap">
                        {{ __('Wanita') }}
                    </th>
                    <th scope="col" class="p-0 px-6 w-60 lg:table-cell whitespace-nowrap">
                        {{ __('Provinsi/Luar Negeri') }}
                    </th>
                    <th scope="col" class="p-0 px-3 w-80 lg:table-cell whitespace-nowrap">
                        {{ __('Kabupaten/Negara') }}
                    </th>
                    <th scope="col" class="w-24 py-3 px-7 lg:table-cell">
                        {{ __('Tahun') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penyalurans as $penyaluran)
                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                        <td class="p-2 text-center text-gray-900 dark:text-gray-200">
                            <div class="flex justify-center">
                                <div class="hover:underline whitespace-nowrap">
                                    {{ $penyaluran->id }}
                                </div>
                            </div>
                        </td>

                        <td scope="row"
                            class="w-40 p-0 px-1 text-center text-gray-500 font-base dark:text-gray-400 xl:table-cell">
                            <div class="flex justify-center whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->tanggal->isoFormat('LL') }}
                                </p>
                            </div>
                        </td>

                        <td scope="row"
                            class="flex justify-start px-6 py-4 font-medium text-gray-900 dark:text-gray-200 w-36">
                            <div class="flex">
                                <a href="{{ route('penyaluran.show', $penyaluran) }}"
                                    class="hover:underline whitespace-nowrap">
                                    {{ Str::limit($penyaluran->uraian, 10, '...') }}
                                </a>
                            </div>
                        </td>

                        <td class="p-0 px-11 lg:table-cell w-96">
                            <div class="flex">
                                <p>
                                    {{ $penyaluran->programSumber->sumberDonasi->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-4 lg:table-cell min-w-[200px]">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->programSumber->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-4 lg:table-cell min-w-[200px]">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->sumberDana->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td wire:key="nominal-{{ $penyaluran->id }}" x-data="{
                            nominal: {{ $penyaluran->nominal }},
                            updateNominal() {
                                this.nominal = {{ $penyaluran->nominal }}
                            }
                        }" x-init="Livewire.on('dataUpdated', () => {
                            updateNominal()
                        })"
                            class="p-0 px-4 lg:table-cell min-w-[180px]">
                            <div class="flex justify-between">
                                <p>Rp.</p>
                                <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                            </div>
                        </td>

                        <td class="p-0 px-3 lg:table-cell min-w-[200px]">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->programPilar->pilar->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="p-0 px-4 lg:table-cell min-w-[200px]">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ Str::limit($penyaluran->programPilar->name, 30, '...') }}
                                </p>
                            </div>
                        </td>

                        <td class="p-0 px-3 text-center lg:table-cell">
                            <div class="flex justify-center whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->ashnaf->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penyaluran->lembaga_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penyaluran->male_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penyaluran->female_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-4 lg:table-cell">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->kabupaten->provinsi->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="p-0 px-3 lg:table-cell">
                            <div class="flex whitespace-nowrap">
                                <p>
                                    {{ $penyaluran->kabupaten->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penyaluran->tahun->name ?? '-' }}
                                </p>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                            Empty
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card.app>
