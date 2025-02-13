<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Penyaluran;
use App\Models\TargetPilar;
use Livewire\Attributes\On;
use App\Models\ProgramPilar;
use Livewire\Attributes\Reactive;

class TasyarufPerPilar extends Component
{
    #[Reactive]
    public $selectedTahun;

    #[Reactive]
    public $pilar;

    #[Reactive]
    public $targetselectedTahun;

    public $programPilars;

    public function mount($selectedTahun, $pilar, $targetselectedTahun)
    {
        $this->selectedTahun = $selectedTahun;
        $this->pilar = $pilar;
        $this->targetselectedTahun = $targetselectedTahun;

        $this->programPilars = ProgramPilar::query()
            ->where('pilar_id', $this->pilar->id)
            ->get()
            ->map(function ($item, $key) {
                $item->setAttribute('index', $key + 1); // Tambahkan indeks secara manual

                return $item;
            });
    }

    public function getPersenPilar($selectedTahun, $pilar)
    {
        return TargetPilar::query()
            ->where('pilar_id', $pilar->id)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');
    }

    public function getTotalLembaga($selectedTahun, $pilar)
    {
        return Penyaluran::query()
        ->whereHas('programPilar', function($query) use ($pilar) {
            $query->where('pilar_id', $pilar->id);
        })
        ->where('tahun_id', $selectedTahun)
        ->where('pindahdana', false)
        ->sum('lembaga_count');
    }

    public function getTotalPria($selectedTahun, $pilar)
    {
        return Penyaluran::query()
        ->whereHas('programPilar', function($query) use ($pilar) {
            $query->where('pilar_id', $pilar->id);
        })
        ->where('tahun_id', $selectedTahun)
        ->where('pindahdana', false)
        ->sum('male_count');
    }

    public function getTotalWanita($selectedTahun, $pilar)
    {
        return Penyaluran::query()
        ->whereHas('programPilar', function($query) use ($pilar) {
            $query->where('pilar_id', $pilar->id);
        })
        ->where('tahun_id', $selectedTahun)
        ->where('pindahdana', false)
        ->sum('female_count');
    }

    public function getTotalRealisasi($selectedTahun, $pilar)
    {
        return Penyaluran::query()
        ->whereHas('programPilar', function($query) use ($pilar) {
            $query->where('pilar_id', $pilar->id);
        })
        ->where('tahun_id', $selectedTahun)
        ->where('pindahdana', false)
        ->sum('nominal');
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        $persenPilar = $this->getPersenPilar($this->selectedTahun, $this->pilar);
        $nominalTargetPilar = ($this->targetselectedTahun * $persenPilar) / 100;
        $lembagaPilar = $this->getTotalLembaga($this->selectedTahun, $this->pilar);
        $lakiPilar = $this->getTotalPria($this->selectedTahun, $this->pilar);
        $perempuanPilar = $this->getTotalWanita($this->selectedTahun, $this->pilar);
        $realisasiPilar = $this->getTotalRealisasi($this->selectedTahun, $this->pilar);
        return view('livewire.dashboard.tasyaruf-per-pilar', compact(
            'persenPilar',
            'nominalTargetPilar',
            'lembagaPilar',
            'lakiPilar',
            'perempuanPilar',
            'realisasiPilar'
        ));
    }
}
