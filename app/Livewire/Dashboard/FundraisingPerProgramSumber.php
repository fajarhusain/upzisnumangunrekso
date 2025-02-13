<?php

namespace App\Livewire\Dashboard;

use App\Models\Penghimpunan;
use App\Models\TargetProgramSumber;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class FundraisingPerProgramSumber extends Component
{
    #[Reactive]
    public $selectedTahun;

    #[Reactive]
    public $programSumber;

    public $nominalTargetInduk;

    public function mount($selectedTahun, $programSumber, $nominalTargetInduk)
    {
        $this->selectedTahun = $selectedTahun;
        $this->programSumber = $programSumber;
        $this->nominalTargetInduk = $nominalTargetInduk;
    }

    public function getPersenProSum($selectedTahun, $programSumber)
    {
        return TargetProgramSumber::query()
            ->where('program_sumber_id', $programSumber->id)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');
    }

    public function getRealisasiProsum($selectedTahun, $programSumber)
    {
        return Penghimpunan::query()
            ->where('program_sumber_id', $programSumber->id)
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
        $persenTargetProSum = $this->getPersenProSum($this->selectedTahun, $this->programSumber);
        $nominalRealisasiProSum = $this->getRealisasiProsum($this->selectedTahun, $this->programSumber);

        $nominalTargetProSum = ($this->nominalTargetInduk * $persenTargetProSum) / 100;

        return view('livewire.dashboard.fundraising-per-program-sumber', compact([
            'persenTargetProSum',
            'nominalRealisasiProSum',
            'nominalTargetProSum',
        ]));
    }
}
