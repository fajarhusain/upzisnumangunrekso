<x-card.app>
    <x-card.title>
        {{ __('Tabel Saldo') }}
    </x-card.title>
    <div class="relative mt-6 overflow-auto rounded-md shadow-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900">
        <table class="w-full text-gray-700 table-auto dark:text-gray-300">
            <thead class="text-sm text-white uppercase bg-green-600 dark:bg-green-800">
                <tr>
                    <th rowspan="2" class="px-4 py-3 text-center border">No.</th>
                    <th rowspan="2" class="px-6 py-3 border">Nama Sumber Saldo</th>
                    <th colspan="3" class="px-6 py-3 text-center border">Saldo</th>
                </tr>
                <tr class="bg-green-500 dark:bg-green-700 border-t border-white">
    <th class="px-6 py-3 text-center border border-white">Zakat</th>
    <th class="px-6 py-3 text-center border border-white">Infaq</th>
    <th class="px-6 py-3 text-center border border-white">Amil</th>
</tr>

            </thead>
            <tbody>
                @forelse ($sumberDonasis as $sumberDonasi)
                    <livewire:dashboard.saldo-per-sumber-donasi :selectedTahun="$this->selectedTahun" :sumberDonasi="$sumberDonasi" :key="$sumberDonasi->id" />
                @empty
                    <tr class="bg-gray-100 dark:bg-gray-800">
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada data</td>
                    </tr>
                @endforelse
                <tr class="bg-green-100 dark:bg-green-900 font-semibold">
                    <td class="px-6 py-2 border" rowspan="3" colspan="2">Total Zakat & Infaq</td>
                    <td class="px-6 py-2 border">Rp. {{ number_format($totalZakat, 0, ',', '.') }}</td>
                    <td class="px-6 py-2 border">Rp. {{ number_format($totalInfaq, 0, ',', '.') }}</td>
                    <td class="px-6 py-2 border" rowspan="2">Rp. {{ number_format($totalAmil, 0, ',', '.') }}</td>
                </tr>
                <tr class="bg-green-200 dark:bg-green-800">
                    <td class="px-6 py-2 border" colspan="2">Rp. {{ number_format($totalZakatInfaq, 0, ',', '.') }}</td>
                </tr>
                <tr class="bg-green-300 dark:bg-green-700">
                    <td class="px-6 py-2 border" colspan="3">Rp. {{ number_format($totalSemua, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        <canvas id="saldoChart"></canvas>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('saldoChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Zakat', 'Infaq', 'Amil'],
                    datasets: [{
                        label: 'Saldo',
                        data: [{{ $totalZakat }}, {{ $totalInfaq }}, {{ $totalAmil }}],
                        backgroundColor: ['#16A34A', '#22C55E', '#10B981'],
                        borderColor: '#065F46',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</x-card.app>
