<?php

namespace App\Livewire\Penghimpunan;

use App\Exports\PenghimpunansExport;
use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Carbon\Carbon;
use Livewire\Component;

class ExportFilter extends Component
{
    public $dateStart;

    public $dateEnd;

    public $bulan;

    public $selectedBulan = '';

    public $tahuns;

    public $selectedTahun = '';

    public $sumberDonasis;

    public $selectedSumberDonasi = '';

    public $programSumbers;

    public $selectedProgramSumber = '';

    public $sumberDanas;

    public $selectedSumberDana = '';

    public function mount()
    {
        $this->dateEnd = Carbon::now()->format('Y-m-d');
        $this->sumberDonasis = SumberDonasi::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDanas = SumberDana::query()->get();
        $this->tahuns = Tahun::query()->get();
    }

    public function exportExel()
    {
        return (new PenghimpunansExport(str($this->dateStart),str($this->dateEnd),str($this->selectedBulan), str($this->selectedTahun),str($this->selectedSumberDonasi),  str($this->selectedProgramSumber), str($this->selectedSumberDana)))->download('Penghimpunan.xlsx');
    }

    public function exportCsv()
    {
        return (new PenghimpunansExport(str($this->dateStart),str($this->dateEnd),str($this->selectedBulan), str($this->selectedTahun),str($this->selectedSumberDonasi),  str($this->selectedProgramSumber), str($this->selectedSumberDana)))->download('Penghimpunan.csv');
    }

    public function render()
    {
        $penghimpunans = Penghimpunan::orderByDesc('tanggal')
            ->when($this->dateStart && $this->dateEnd, function ($query) {
                $query->whereBetween('tanggal', [
                    Carbon::parse($this->dateStart)->startOfDay(),
                    Carbon::parse($this->dateEnd)->endOfDay(),
                ]);
            })
            ->when($this->selectedBulan, function ($query) {
                $query->whereMonth('tanggal', $this->selectedBulan);
            })
            ->when($this->selectedTahun, function ($query) {
                $query->where('tahun_id', $this->selectedTahun);
            })
            ->when($this->selectedSumberDonasi, function ($query) {
                $query->whereHas('programSumber', function ($query) {
                    $query->where('sumber_donasi_id', $this->selectedSumberDonasi);
                });
            })
            ->when($this->selectedProgramSumber, function ($query) {
                $query->where('program_sumber_id', $this->selectedProgramSumber);
            })
            ->when($this->selectedSumberDana, function ($query) {
                $query->where('sumber_dana_id', $this->selectedSumberDana);
            })
            ->get();

        return view('livewire.penghimpunan.export-filter', ['penghimpunans' => $penghimpunans]);
    }
}
