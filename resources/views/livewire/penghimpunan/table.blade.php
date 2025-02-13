<div>
    <div class="w-full mt-6">
        <div class="flex flex-col justify-between gap-2 xl:flex-row">
            <div class="flex items-center w-full gap-2 lg:w-1/3" x-data="{ massage: '' }">
                <div class="relative flex flex-col w-full max-w-xs gap-1 text-gray-600 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" aria-hidden="true"
                        class="absolute left-2.5 top-1/2 size-5 -translate-y-1/2 text-gray-600/50 dark:text-gray-300/50">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input wire:model.live.debounce="search" id="search_id" type="search"
                        class="w-full py-3 pl-10 pr-2 text-sm border border-gray-300 rounded-md bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-gray-700 dark:bg-gray-900/50 dark:focus-visible:outline-white"
                        name="search" placeholder="Search" aria-label="search" />
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-end gap-2">
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
        <table class="w-full text-base text-gray-500 dark:text-gray-400">
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
                    <th scope="col" class="px-6 py-3 lg:table-cell min-w-44">
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
                    @can('update', App\Models\Penghimpunan::class)
                        <th scope="col" class="w-24 py-3 pl-6 pr-2 text-center lg:pr-4">
                            {{ __('Option') }}
                        </th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($penghimpunans as $penghimpunan)
                    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200 ">
                            <div class="flex justify-center">
                                {{ ($penghimpunans->currentpage() - 1) * $penghimpunans->perpage() + $loop->index + 1 }}
                            </div>
                        </td>
                        <td scope="row"
                            class="px-4 py-2 text-gray-500 font-base dark:text-gray-400 xl:table-cell whitespace-nowrap">
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

                        <td class="px-4 py-2 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->lembaga_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->male_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->female_count ?? '-' }}
                                </p>
                            </div>
                        </td>

                        <td class="px-4 py-2 text-center lg:table-cell">
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
                        <td class="px-4 py-2 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->tahun->name ?? '-' }}
                                </p>
                            </div>
                        </td>
                        <td class="px-4 py-2 text-center lg:table-cell">
                            <div class="flex justify-center">
                                <p>
                                    {{ $penghimpunan->editedBy->name ?? '-' }}
                                </p>
                            </div>
                        </td>
                        @can('update', App\Models\Penghimpunan::class)
                            <td class="px-4 py-2 text-center lg:pr-4">
                                <div class="flex justify-center space-x-2 justify-items-center">
                                    @if ($penghimpunan->lampiran)
                                        <a href="{{ $penghimpunan->lampiran }}" target="_blank"
                                            rel="noopener noreferrer" class="text-green-500 hover:underline">Lampiran</a>
                                    @endif
                                    <a href="{{ route('penghimpunan.show', $penghimpunan) }}"
                                        class="hover:underline">Detail</a>
                                    <a href="{{ route('penghimpunan.edit', $penghimpunan) }}"
                                        class="text-indigo-500 hover:underline">Edit</a>
                                    <button x-data="" class="text-red-500 hover:underline"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{ $penghimpunan->id }}')">
                                        Hapus
                                    </button>

                                    <x-modal name="confirm-user-deletion{{ $penghimpunan->id }}" :show="$errors->userDeletion->isNotEmpty()"
                                        focusable>
                                        <form method="post" action="{{ route('penghimpunan.destroy', $penghimpunan) }}"
                                            class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                Apakah anda yakin ingin menghapus data ini?
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ $penghimpunan->uraian }}
                                            </p>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ $penghimpunan->tanggal->format('d F Y') }}
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
                        @endcan
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-800">
                        <td scope="row" class="px-4 py-2 font-medium text-gray-900 dark:text-gray-200">
                            Empty
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td wire:key="nominal-{{ $totalNominal }}" x-data="{
                        nominal: {{ $totalNominal }},
                    }"
                        class="px-4 py-2 lg:table-cell whitespace-nowrap">
                        <div class="flex justify-between">
                            <p>Rp.</p>
                            <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                        </div>
                    </td>

                    <td class="px-4 py-2 text-center lg:table-cell">
                        <div class="flex justify-center">
                            <p>
                                {{ $lembagaCount ?? '-' }}
                            </p>
                        </div>
                    </td>

                    <td class="px-4 py-2 text-center lg:table-cell">
                        <div class="flex justify-center">
                            <p>
                                {{ $maleCount ?? '-' }}
                            </p>
                        </div>
                    </td>

                    <td class="px-4 py-2 text-center lg:table-cell">
                        <div class="flex justify-center">
                            <p>
                                {{ $femaleCount ?? '-' }}
                            </p>
                        </div>
                    </td>

                    <td class="px-4 py-2 text-center lg:table-cell">
                        <div class="flex justify-center">
                            <p>
                                {{ $noNameCount ?? '-' }}
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            {{ $penghimpunans->Links() }}
        </div>
    </div>
</div>
