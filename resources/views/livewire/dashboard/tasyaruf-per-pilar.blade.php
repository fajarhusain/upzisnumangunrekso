<div>
    <tr class="bg-green-700 dark:bg-green-900 text-white">
        <td class="justify-center w-2 py-4 pl-6 font-medium"></td>
        <td class="px-6 py-4 lg:table-cell" colspan="6">
            Pilar {{ $pilar->name }} ({{ $persenPilar }}%)
        </td>
    </tr>
    @foreach ($programPilars as $programPilar)
        <livewire:dashboard.tasyaruf-per-program-pilar :selectedTahun="$this->selectedTahun" :nominalTargetPilar="$nominalTargetPilar" :programPilar="$programPilar"
            :key="$pilar->id" />
    @endforeach
    <tr class="bg-green-300 dark:bg-green-700 text-black dark:text-white">
        <td class="px-6 py-4 lg:table-cell"></td>
        <td class="px-6 py-4 lg:table-cell"></td>
        <td wire:key="nominal-{{ $nominalTargetPilar }}" x-data="{ nominal: {{ $nominalTargetPilar }} }" class="px-6 py-4 lg:table-cell min-w-44">
            <div class="flex justify-between">
                <p>Rp.</p>
                <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
            </div>
        </td>
        <td class="px-6 py-4 text-center lg:table-cell">
            {{ $lembagaPilar }}
        </td>
        <td class="px-6 py-4 text-center lg:table-cell">
            {{ $lakiPilar }}
        </td>
        <td class="px-6 py-4 text-center lg:table-cell">
            {{ $perempuanPilar }}
        </td>
        <td wire:key="nominal-{{ $realisasiPilar }}" x-data="{ nominal: {{ $realisasiPilar }} }" class="px-6 py-4 lg:table-cell min-w-44">
            <div class="flex justify-between">
                <p>Rp.</p>
                <p x-text="nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')"></p>
            </div>
        </td>
    </tr>
</div>
