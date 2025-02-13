<div>
    <div class="w-full mt-6">
        <div class="flex flex-col justify-between gap-2 xl:flex-row">
            <div class="flex items-center w-full gap-2 lg:w-1/3" x-data="{ massage: '' }">
                <div class="relative flex flex-col w-full max-w-xs gap-1 text-gray-600 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" aria-hidden="true"
                        class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-gray-600/50 dark:text-gray-300/50">
                        <path stroke-linecwap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input wire:model.live.debounce="search" id="search_id" type="search"
                        class="w-full py-3 pl-10 pr-2 text-sm border border-gray-300 rounded-md bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900/50 dark:focus-visible:outline-white"
                        name="search" placeholder="Search" aria-label="search" />
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-end gap-2">
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
                    <option value="zakat">Zakat</option>
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
                    <option value="">{{ __('Provinsi/Luar Negeri') }}</option>
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}">
                            {{ $provinsi->name }}
                        </option>
                    @endforeach
                </x-select-input>
                <x-select-input wire:model.lazy="selectedKabupaten" id="kabupaten" class="">
                    <option value="">{{ __('Kabupaten/Negara') }}</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}">
                            {{ $kabupaten->name }}
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
                    <option value="">{{ __('Program') }}</option>
                    @foreach ($programPilars as $programPilar)
                        <option value="{{ $programPilar->id }}">
                            {{ $programPilar->name }}
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
                <x-select-input id="paginate" wire:model.lazy="paginate" class="">
                    <option value="">{{ __('Per Halaman') }}</option>
                    <option value="30">
                        30
                    </option>
                    <option value="50">
                        50
                    </option>
                    <option value="70">
                        70
                    </option>
                    <option value="100">
                        100
                    </option>
                </x-select-input>
            </div>
        </div>
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
                    <th scope="col" class="w-24 px-6 py-3 lg:table-cell">
                        {{ __('Edit By') }}
                    </th>
                    <th scope="col" class="p-0 text-center w-60 lg:pr-4 whitespace-nowrap">
                        {{ __('Option') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penyalurans as $penyaluran)
                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                        <td class="p-2 text-center text-gray-900 dark:text-gray-200">
                            <div class="flex justify-center">
                                <div class="hover:underline whitespace-nowrap">
                                    {{ ($penyalurans->currentpage() - 1) * $penyalurans->perpage() + $loop->index + 1 }}
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
                                    {{ $penyaluran->programPilar?->name ? Str::limit($penyaluran->programPilar->name, 30, '...') : '-' }}
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

                        <td class="px-6 py-4 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penyaluran->editedBy->name ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 text-center lg:pr-4">
                            <div class="flex justify-center space-x-2 justify-items-center">
                                @if ($penyaluran->lampiran)
                                    <a href="{{ $penyaluran->lampiran }}" target="_blank" rel="noopener noreferrer"
                                        class="text-green-500 hover:underline">Lampiran</a>
                                @endif
                                <a href="{{ route('penyaluran.show', $penyaluran) }}"
                                    class="hover:underline">Lihat</a>
                                <a href="{{ route('penyaluran.edit', $penyaluran) }}"
                                    class="text-indigo-500 hover:underline">Ubah</a>
                                <button x-data="" class="text-red-500 hover:underline"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{ $penyaluran->id }}')">
                                    Hapus
                                </button>

                                <x-modal name="confirm-user-deletion{{ $penyaluran->id }}" :show="$errors->userDeletion->isNotEmpty()"
                                    focusable>
                                    <form method="post" action="{{ route('penyaluran.destroy', $penyaluran) }}"
                                        class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            Apakah anda yakin ingin menghapus data ini?
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $penyaluran->uraian }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $penyaluran->tanggal->format('d F Y') }}
                                        </p>

                                        <div class="flex justify-end mt-6">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Batal') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ms-3">
                                                {{ __('Hapus') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
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
                <tr>
                    <td class="px-6 py-4 lg:table-cell">
                        <div class="flex">
                            {{ __('Jumlah') }}
                        </div>
                    </td>

                    <td>

                    </td>

                    <td>

                    </td>

                    <td>

                    </td>
                    <td>

                    </td>

                    <td>

                    </td>

                    {{-- @dump($totalNominal) --}}
                    <td wire:key="nominal-{{ $totalNominal }}" x-data="{
                        nominal: {{ $totalNominal }},
                        updateNominal() {
                            this.nominal = {{ $totalNominal }}
                        }
                    }" x-init="Livewire.on('dataUpdated', () => {
                        updateNominal()
                    })"
                        class="p-0 px-4 lg:table-cell">
                        <div class="flex justify-between">
                            <p>Rp.</p>
                            <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                        </div>
                    </td>

                    <td>

                    </td>

                    <td>

                    </td>

                    <td>

                    </td>

                    <td class="px-6 py-4 text-center lg:table-cell">
                        <div class="flex justify-center">
                            <p>{{ $lembagaCount }}</p>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center lg:table-cell">
                        <div class="flex justify-center">
                            {{ $maleCount }}
                        </div>
                    </td>

                    <td class="px-6 py-4 text-centerlg:table-cell">
                        <div class="flex justify-center">
                            {{ $femaleCount }}
                        </div>
                    </td>

                    <td>

                    </td>

                    <td>

                    </td>

                    <td>

                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            {{ $penyalurans->Links() }}
        </div>
    </div>
</div>
