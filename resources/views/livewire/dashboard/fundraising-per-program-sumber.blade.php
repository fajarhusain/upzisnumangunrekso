<tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-100 even:dark:bg-gray-700">
    <td class="justify-center w-2 py-4 pl-6 font-medium text-gray-900 dark:text-gray-200">
        {{ $programSumber->index }}
    </td>
    <td class="px-6 py-4 lg:table-cell">
        {{ $programSumber->name }}({{ $persenTargetProSum }}%)
    </td>
    <td wire:key="nominal-{{ $nominalTargetProSum }}" x-data="{ nominal: {{ $nominalTargetProSum }} }" class="px-6 py-4 lg:table-cell min-w-44">
        <div class="flex justify-between">
            <p>Rp.</p>
            <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
        </div>
    </td>
    <td wire:key="nominal-{{ $nominalRealisasiProSum }}" x-data="{ nominal: {{ $nominalRealisasiProSum }} }" class="px-6 py-4 lg:table-cell min-w-44">
        <div class="flex justify-between">
            <p>Rp.</p>
            <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
        </div>
    </td>
</tr>
