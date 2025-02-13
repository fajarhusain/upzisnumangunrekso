<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Penyaluran;
use Livewire\Attributes\On;
use App\Models\Penghimpunan;
use Livewire\Attributes\Reactive;

class SaldoPerSumberDana extends Component
{
    #[Reactive]
    public $selectedTahun;

    #[Reactive]
    public $sumberDana;

    #[Reactive]
    public $sumberDonasi;

    public function mount($selectedTahun, $sumberDana, $sumberDonasi)
    {
        $this->$selectedTahun = $selectedTahun;
        $this->sumberDana = $sumberDana;
        $this->sumberDonasi = $sumberDonasi;
    }

    public function getSaldo($selectedTahun, $sumberDana, $sumberDonasi)
    {
        $tunaiSaldoPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->where('sumber_donasi_id', $sumberDonasi->id);
            })
            ->where('sumber_dana_id', $sumberDana->id)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');

        $tunaiSaldoPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->where('sumber_donasi_id', $sumberDonasi->id);
            })
            ->where('sumber_dana_id', $sumberDana->id)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');

        return $tunaiSaldoPenghimpunan - $tunaiSaldoPenyaluran;
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        $saldoPerSumberDana = $this->getSaldo($this->selectedTahun, $this->sumberDana, $this->sumberDonasi);

        return view('livewire.dashboard.saldo-per-sumber-dana', ['saldoPerSumberDana' => $saldoPerSumberDana, 'sumberDana' => $this->sumberDana]);
    }
}
