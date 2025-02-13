<x-card.app>
    <div class="justify-between w-full md:flex">
        <x-card.title>
            {{ __('Export Data Penghimpunan') }}
        </x-card.title>
        <div>
            <div class="flex flex-wrap gap-2">
                <x-button.link-primary href="{{ route('penghimpunan.index') }}">
                    {{ __('Cancel') }}
                </x-button.link-primary>
                <x-primary-button wire:click="exportExel">
                    {{ __('Export Exel') }}
                </x-primary-button>
                <x-primary-button wire:click="exportCsv">
                    {{ __('Export CSV') }}
                </x-primary-button>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap items-center justify-end gap-2 mt-2 sm:mt-4">
        <div class="flex items-center">
            <x-input-label for="tanggal" :value="__('Tanggal Awal')" />
            <x-text-input wire:model.lazy='dateStart' id="tanggal" type='date' class="block w-full"
                :value="old('tanggal')" />
        </div>
        <div class="flex items-center">
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
    </div>
    <div class="relative mt-6 overflow-auto rounded-md">
        <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3 text-center">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="px-6 py-3 xl:table-cell">
                        {{ __('Tanggal') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Uraian') }}
                    </th>
                    <th scope="col" class="px-6 py-3 lg:table-cell">
                        {{ __('Nominal') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Lembaga') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Pria') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Wanita') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('No Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left lg:table-cell whitespace-nowrap">
                        {{ __('Sumber Donasi') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left lg:table-cell whitespace-nowrap">
                        {{ __('Program Sumber') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left lg:table-cell whitespace-nowrap">
                        {{ __('Sumber Dana') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center lg:table-cell">
                        {{ __('Tahun') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-center lg:table-cell">
                        {{ __('Edited by') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penghimpunans as $penghimpunan)
                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200">
                            <div class="flex justify-center">
                                    {{ $loop->iteration }}
                            </div>
                        </td>

                        <td scope="row" class="px-4 py-2 text-gray-500 font-base dark:text-gray-400 xl:table-cell whitespace-nowrap">
                            <div class="flex">
                                <p>
                                    {{ $penghimpunan->tanggal->isoFormat('LL') }}
                                </p>
                            </div>
                        </td>

                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200">

                            <div class="flex">
                                <a href="{{ route('penghimpunan.show', $penghimpunan) }}"
                                    class="hover:underline whitespace-nowrap">
                                    {{ Str::limit($penghimpunan->uraian, 10, '...') }}
                                </a>
                            </div>
                        </td>

                        <td wire:key="nominal-{{ $penghimpunan->id }}"
                            x-data="{nominal: {{ $penghimpunan->nominal }}}"
                            class="px-4 py-2 text-right lg:table-cell min-w-44">
                            <div class="flex justify-between">
                                <p>Rp.</p>
                                <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->lembaga_count ?? '-' }}
                                </p>

                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->male_count ?? '-' }}
                                </p>

                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->female_count ?? '-' }}
                                </p>

                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->no_name_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-2 lg:table-cell">
                            <div class="flex">
                                <p>
                                    {{ $penghimpunan->programSumber->sumberDonasi->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-2 lg:table-cell">
                            <div class="flex">
                                <p>
                                    {{ $penghimpunan->programSumber->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-6 py-2 lg:table-cell">
                            <div class="flex">
                                <p>
                                    {{ $penghimpunan->sumberDana->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->tahun->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->editedBy->name ?? '-' }}
                                </p>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200">
                            Empty
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card.app>
