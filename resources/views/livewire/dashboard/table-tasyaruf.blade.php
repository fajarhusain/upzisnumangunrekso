<x-card.app>
    <x-card.title>
        {{ __('Tabel Tasyaruf') }}
    </x-card.title>
    <x-card.description>
        <div class="flex gap-4 text-black dark:text-white">
            <p>Target Tahun ini: Rp.</p>
            <p class="font-bold text-green-700 dark:text-green-300">
                {{ number_format($targetselectedTahun, 0, ',', '.') }}
            </p>
        </div>
    </x-card.description>
    <div class="relative mt-6 overflow-auto rounded-md border border-green-500 dark:border-green-700 shadow-md">
        <table class="w-full text-base text-left text-gray-800 dark:text-gray-200">
            <thead class="bg-green-600 text-white dark:bg-green-800 dark:text-green-100">
                <tr>
                    <th scope="col" rowspan="2" class="px-4 py-3 text-center border-r-2 border-green-400 dark:border-green-300">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">Pilar</th>
                    <th scope="col" class="px-6 py-3 text-center border-x-2 border-green-400 dark:border-green-300" rowspan="2">
                        Perencanaan Sub Pilar
                    </th>
                    <th scope="col" class="px-6 py-3 text-center" colspan="3">Penerima Manfaat</th>
                    <th scope="col" class="px-6 py-3 text-center border-l-2 border-green-400 dark:border-green-300" rowspan="2">
                        Realisasi Sub Pilar
                    </th>
                </tr>
                <tr>
                    <th scope="col" class="px-6 py-3">Pentasyarufan</th>
                    <th scope="col" class="px-6 py-3 text-center">Lembaga</th>
                    <th scope="col" class="px-6 py-3 text-center">L</th>
                    <th scope="col" class="px-6 py-3 text-center">P</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pilars as $pilar)
                    <livewire:dashboard.tasyaruf-per-pilar :selectedTahun="$this->selectedTahun" :pilar="$pilar" :targetselectedTahun="$targetselectedTahun"
                        :key="$pilar->id" />
                @empty
                    <tr class="bg-green-100 dark:bg-green-900">
                        <td scope="row" class="px-6 py-4 font-semibold text-green-900 dark:text-green-300 text-center" colspan="7">
                            Data Tidak Tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card.app>
