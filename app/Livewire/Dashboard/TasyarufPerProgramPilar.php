<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Penyaluran;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use App\Models\TargetProgramPilar;

class TasyarufPerProgramPilar extends Component
{
    #[Reactive]
    public $selectedTahun;

    #[Reactive]
    public $nominalTargetPilar;

    #[Reactive]
    public $programPilar;

    public function mount($selectedTahun, $nominalTargetPilar, $programPilar)
    {
        $this->selectedTahun = $selectedTahun;
        $this->nominalTargetPilar = $nominalTargetPilar;
        $this->programPilar = $programPilar;
    }

    public function getPersenProgramPilar($selectedTahun, $programPilar)
    {
        return TargetProgramPilar::query()
            ->where('program_pilar_id', $programPilar->id)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');
    }

    public function getRealisasiPropil( $selectedTahun,  $programPilar)
    {
        return Penyaluran::query()
            ->where('program_pilar_id', $programPilar->id)
            ->where('tahun_id', $selectedTahun)
            ->where('pindahdana', false)
            ->sum('nominal');
    }

    public function getLembagaCount( $selectedTahun,  $programPilar)
    {
        return Penyaluran::query()
            ->where('program_pilar_id', $programPilar->id)
            ->where('tahun_id', $selectedTahun)
            ->where('pindahdana', false)
            ->sum('lembaga_count');
    }

    public function getPriaCount( $selectedTahun,  $programPilar)
    {
        return Penyaluran::query()
            ->where('program_pilar_id', $programPilar->id)
            ->where('tahun_id', $selectedTahun)
            ->where('pindahdana', false)
            ->sum('male_count');
    }

    public function getWanitaCount( $selectedTahun,  $programPilar)
    {
        return Penyaluran::query()
            ->where('program_pilar_id', $programPilar->id)
            ->where('tahun_id', $selectedTahun)
            ->where('pindahdana', false)
            ->sum('female_count');
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        $persenProgramPilar = $this->getPersenProgramPilar($this->selectedTahun, $this->programPilar);
        $realisasiProgramPilar = $this->getRealisasiPropil($this->selectedTahun, $this->programPilar);
        $lembagaProgramPilar = $this->getLembagaCount($this->selectedTahun, $this->programPilar);
        $lakiProgramPilar = $this->getPriaCount($this->selectedTahun, $this->programPilar);
        $perempuanProgramPilar = $this->getWanitaCount($this->selectedTahun, $this->programPilar);
        $nominalTargetProgramPilar = ($this->nominalTargetPilar * $persenProgramPilar) / 100;
        return view('livewire.dashboard.tasyaruf-per-program-pilar', compact(
            'persenProgramPilar',
            'realisasiProgramPilar',
            'lembagaProgramPilar',
            'lakiProgramPilar',
            'perempuanProgramPilar',
            'nominalTargetProgramPilar'
            ));
    }
}
