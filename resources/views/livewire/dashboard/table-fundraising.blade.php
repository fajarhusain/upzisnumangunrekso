<x-card.app>
    <x-card.title>
        {{ __('Tabel Fundraising') }}
    </x-card.title>
    <x-card.description>
        <div class="flex gap-4 text-black dark:text-white">
            <p>Target Tahun ini: Rp.</p>
            <p>{{ number_format($targetselectedTahun, 0, ',', '.') }}</p>
        </div>
    </x-card.description>
    <div class="relative mt-6 overflow-auto rounded-md">
        <table class="w-full text-base text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg">
            <thead class="text-sm text-white uppercase bg-green-600 dark:bg-green-800">
                <tr>
                    <th class="px-4 py-3 text-center border border-gray-400 dark:border-gray-700">No.</th>
                    <th class="px-6 py-3 border border-gray-400 dark:border-gray-700">Nama Akun</th>
                    <th class="px-6 py-3 text-center border border-gray-400 dark:border-gray-700">Target</th>
                    <th class="px-6 py-3 text-center border border-gray-400 dark:border-gray-700">Realisasi</th>
                    <th class="px-6 py-3 text-center border border-gray-400 dark:border-gray-700">Realisasi sub Pilar</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-green-100 dark:bg-green-900 font-semibold">
                    <td rowspan="2"></td>
                    <td rowspan="2" class="px-6 py-4">Zakat ({{ $targetPersenZakat }}%)</td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($nominalTargetZakat, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">{{ $pembulatanPersenRealisaiZakat }}%</td>
                    <td></td>
                </tr>
                <tr class="bg-green-50 dark:bg-green-800">
                    <td colspan="3" class="px-6 py-4 text-right">Rp. {{ number_format($totalRealisasiZakat, 0, ',', '.') }}</td>
                </tr>
                @foreach ($sumberZakats as $sumberZakat)
                    <livewire:dashboard.fundraising-per-program-sumber :selectedTahun="$this->selectedTahun" :programSumber="$sumberZakat"
                        :nominalTargetInduk="$nominalTargetZakat" :key="$sumberZakat->id">
                @endforeach
                <tr class="bg-green-200 dark:bg-green-700 font-bold">
                    <td></td>
                    <td>Total</td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($nominalTargetZakat, 0, ',', '.') }}</td>
                    <td></td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($totalRealisasiZakat, 0, ',', '.') }}</td>
                </tr>
                
                <tr class="bg-blue-100 dark:bg-blue-900 font-semibold">
                    <td></td>
                    <td>Infaq ({{ $targetPersenInfaq }}%)</td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($nominalTargetInfaq, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">{{ $pembulatanPersenRealisaiInfaq }}%</td>
                    <td></td>
                </tr>
                @foreach ($sumberInfaqNonRutins as $sumberInfaqNonRutin)
                    <livewire:dashboard.fundraising-per-program-sumber :selectedTahun="$this->selectedTahun" :programSumber="$sumberInfaqNonRutin"
                        :nominalTargetInduk="$nominalTargetInfaqNonRutin" :key="$sumberInfaqNonRutin->id">
                @endforeach
                <tr class="bg-blue-200 dark:bg-blue-700 font-bold">
                    <td></td>
                    <td>Total</td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($nominalTargetInfaqNonRutin, 0, ',', '.') }}</td>
                    <td></td>
                    <td class="px-6 py-4 text-right">Rp. {{ number_format($totalRealisasiInfaqNonRutin, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-card.app>
