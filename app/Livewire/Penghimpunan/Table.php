<?php

namespace App\Livewire\Penghimpunan;

use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $dateStart;

    public $dateEnd;

    public $bulan;

    public $selectedBulan;

    public $tahuns;

    public $selectedTahun;

    public $sumberDonasis;

    public $selectedSumberDonasi;

    public $programSumbers;

    public $selectedProgramSumber;

    public $sumberDanas;

    public $selectedSumberDana;

    // #[Validate('required')]
    #[Url(as: 'pencarian', history: true, keep: true)]
    public $search;

    public $paginate = 30;

    public function mount()
    {
        $this->dateEnd = Carbon::now()->format('Y-m-d');
        $this->selectedTahun = Tahun::query()
            ->where('name', Carbon::now()->year)
            ->first()->id;
        $this->sumberDonasis = SumberDonasi::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDanas = SumberDana::query()->get();
        $this->tahuns = Tahun::query()->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedDateStart()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedDateEnd()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedSelectedTahun()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedSelectedBulan()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedSelectedSumberDonasi()
    {
        $this->programSumbers = ProgramSumber::query()->where('sumber_donasi_id', $this->selectedSumberDonasi)->get();
        $this->reset('selectedProgramSumber');
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedSelectedSumberDana()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function updatedSelectedProgramSumber()
    {
        $this->resetPage();
        $this->dispatch('dataUpdated');
    }

    public function formatRupiah($value)
    {
        return 'Rp. '.number_format($value, 0, ',', '.');
    }

    #[On('dataUpdated')]
    public function render()
    {
        // Get the filtered data
        $penghimpunansQuery = Penghimpunan::orderByDesc('tanggal')
            ->when($this->search, function ($query) {
                $query->where('uraian', 'like', '%'.$this->search.'%');
            })
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
            });

        $penghimpunans = $penghimpunansQuery->paginate($this->paginate);

        $totalNominal = $penghimpunansQuery->sum('nominal');
        $lembagaCount = $penghimpunansQuery->sum('lembaga_count');
        $maleCount = $penghimpunansQuery->sum('male_count');
        $femaleCount = $penghimpunansQuery->sum('female_count');
        $noNameCount = $penghimpunansQuery->sum('no_name_count');

        return view('livewire.penghimpunan.table', ['penghimpunans' => $penghimpunans, 'totalNominal' => $totalNominal, 'lembagaCount' => $lembagaCount, 'maleCount' => $maleCount, 'femaleCount' => $femaleCount, 'noNameCount' => $noNameCount]);
    }
}
