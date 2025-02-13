    <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
        <td class="justify-center w-2 py-4 pl-6 font-medium text-gray-900 dark:text-gray-200">
            {{ $sumberDana->index }}
        </td>
        <td class="px-6 py-4 text-left lg:table-cell">
            {{ $sumberDana->name }}
        </td>
        @if ($sumberDonasi->name == 'Zakat')
            <td wire:key="nominal-{{ $saldoPerSumberDana }}" x-data="{ nominal: {{ $saldoPerSumberDana }} }"
                class="px-6 py-4 lg:table-cell">
                <div class="flex justify-between">
                    <p>Rp.</p>
                    <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                </div>
            </td>
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
        @elseif ($sumberDonasi->name == 'Infaq')
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
            <td wire:key="nominal-{{ $saldoPerSumberDana }}" x-data="{
                nominal: {{ $saldoPerSumberDana }},
            }"
                class="px-6 py-4 lg:table-cell">
                <div class="flex justify-between">
                    <p>Rp.</p>
                    <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                </div>
            </td>
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
        @else
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
            <td class="px-6 py-4 text-right lg:table-cell">-</td>
            <td wire:key="nominal-{{ $saldoPerSumberDana }}" x-data="{
                nominal: {{ $saldoPerSumberDana }},
            }"
                class="px-6 py-4 lg:table-cell">
                <div class="flex justify-between">
                    <p>Rp.</p>
                    <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
                </div>
            </td>
        @endif
    </tr>
