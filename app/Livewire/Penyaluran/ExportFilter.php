<?php

namespace App\Livewire\Penyaluran;

use Carbon\Carbon;
use App\Models\Pilar;
use App\Models\Tahun;
use App\Models\Ashnaf;
use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Penyaluran;
use App\Models\SumberDana;
use App\Models\ProgramPilar;
use App\Models\SumberDonasi;
use App\Models\ProgramSumber;
use App\Exports\PenyaluransExport;

class ExportFilter extends Component
{
    public $tahuns;

    public $selectedTahun = '';

    public $bulan;

    public $selectedBulan = '';

    public $dateStart;

    public $dateEnd;

    public $provinsis;

    public $selectedProvinsi = '';

    public $kabupatens;

    public $selectedKabupaten = '';

    public $ashnafs;

    public $selectedAshnaf = '';

    public $lembaga;

    public $pria;

    public $wanita;

    public $pilars;

    public $selectedPilar = '';

    public $programPilars;

    public $selectedProgramPilar = '';

    public $sumberDanas;

    public $selectedSumberDana = '';

    public $programSumbers;

    public $selectedProgramSumber = '';

    public $sumberDonasis;

    public $selectedSumberDonasi = '';

    public $nominal;

    public function mount()
    {
        $this->dateEnd = Carbon::now()->format('Y-m-d');
        $this->tahuns = Tahun::query()->get();
        $this->provinsis = Provinsi::query()->get();
        $this->kabupatens = Kabupaten::query()->get();
        $this->ashnafs = Ashnaf::query()->get();
        $this->pilars = Pilar::query()->get();
        $this->programPilars = ProgramPilar::query()->get();
        $this->sumberDanas = SumberDana::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDonasis = SumberDonasi::query()->get();

    }

    public function updatedDateStart()
    {
        // $this->resetPage();
        // $this->dispatch('dataUpdated');
    }

    public function updatedDateEnd()
    {
        // $this->resetPage();
        // $this->dispatch('dataUpdated');
    }

    public function updatedSelectedBulan()
    {
        // $this->resetPage();
    }

    public function updatedSelectedTahun()
    {
        // $this->resetPage();
    }

    public function updatedSelectedProvinsi()
    {
        $this->kabupatens = Kabupaten::query()->where('provinsi_id', $this->selectedProvinsi)->get();
        // $this->resetPage();
        $this->reset('selectedKabupaten');
    }

    public function updatedSelectedKabupaten()
    {
        // $this->resetPage();
    }

    public function updatedSelectedAshnaf()
    {
        // $this->resetPage();
    }

    public function updatedSelectedPilar()
    {
        $this->programPilars = ProgramPilar::query()->where('pilar_id', $this->selectedPilar)->get();
        // $this->resetPage();
        $this->reset('selectedProgramPilar');
    }

    public function updatedSelectedProgramPilar()
    {
        // $this->resetPage();
    }

    public function exportExel()
    {
        return (new PenyaluransExport(str($this->selectedBulan), str($this->selectedTahun), str($this->selectedProvinsi), str($this->selectedKabupaten), str($this->selectedAshnaf), str($this->selectedPilar), str($this->selectedProgramPilar), str($this->selectedSumberDana), str($this->selectedProgramSumber), str($this->selectedSumberDonasi)))->download('Penyaluran.xlsx');
    }

    public function exportCsv()
    {
        return (new PenyaluransExport(str($this->selectedBulan), str($this->selectedTahun), str($this->selectedProvinsi), str($this->selectedKabupaten), str($this->selectedAshnaf), str($this->selectedPilar), str($this->selectedProgramPilar), str($this->selectedSumberDana), str($this->selectedProgramSumber), str($this->selectedSumberDonasi)))->download('Penyaluran.csv');
    }

    public function render()
    {
        $penyalurans = Penyaluran::orderByDesc('tanggal')
            ->when($this->dateStart && $this->dateEnd, function ($query) {
                $query->whereBetween('tanggal', [Carbon::parse($this->dateStart)->startOfDay(),
                Carbon::parse($this->dateEnd)->endOfDay()]);
            })
            ->when($this->selectedBulan, function ($query) {
                $query->whereMonth('tanggal', $this->selectedBulan);
            })
            ->when($this->selectedTahun, function ($query) {
                $query->where('tahun_id', $this->selectedTahun);
            })
            ->when($this->selectedProvinsi, function ($query) {
                $query->whereHas('kabupaten', function ($query) {
                    $query->where('provinsi_id', $this->selectedProvinsi);
                });
            })
            ->when($this->selectedKabupaten, function ($query) {
                $query->where('kabupaten_id', $this->selectedKabupaten);
            })
            ->when($this->selectedAshnaf, function ($query) {
                $query->where('ashnaf_id', $this->selectedAshnaf);
            })
            ->when($this->selectedPilar, function ($query) {
                $query->whereHas('programPilar', function ($query) {
                    $query->where('pilar_id', $this->selectedPilar);
                });
            })
            ->when($this->selectedProgramPilar, function ($query) {
                $query->where('program_pilar_id', $this->selectedProgramPilar);
            })
            ->when($this->selectedSumberDana, function ($query) {
                $query->where('sumber_dana_id', $this->selectedSumberDana);
            })
            ->when($this->selectedProgramSumber, function ($query) {
                $query->where('program_sumber_id', $this->selectedProgramSumber);
            })
            ->when($this->selectedSumberDonasi, function ($query) {
                $query->whereHas('programSumber', function ($query) {
                    $query->where('sumber_donasi_id', $this->selectedSumberDonasi);
                });
            })
            ->get();

        return view('livewire.penyaluran.export-filter', ['penyalurans' => $penyalurans]);
    }
}
