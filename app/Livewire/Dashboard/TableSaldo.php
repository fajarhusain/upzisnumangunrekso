<?php

namespace App\Livewire\Dashboard;

use App\Models\Penghimpunan;
use App\Models\Penyaluran;
use App\Models\SumberDonasi;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class TableSaldo extends Component
{
    #[Reactive]
    public $selectedTahun;

    public $sumberDonasis;

    public function mount($selectedTahun)
    {
        $this->$selectedTahun = $selectedTahun;
        $this->sumberDonasis = SumberDonasi::query()->get();
    }

    public function getSaldoSumberDonasi($selectedTahun, $sumberDonasi)
    {
        $tunaiSaldoPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->whereHas('sumberDonasi', function ($query) use ($sumberDonasi) {
                    $query->where('name', $sumberDonasi);
                });
            })
            ->whereHas('sumberDana', function ($query) use ($sumberDonasi) {
                $query->where('name', 'like', '%'.$sumberDonasi.'%');
            })
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');

        $tunaiSaldoPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->whereHas('sumberDonasi', function ($query) use ($sumberDonasi) {
                    $query->where('name', $sumberDonasi);
                });
            })
            ->whereHas('sumberDana', function ($query) use ($sumberDonasi) {
                $query->where('name', 'like', '%'.$sumberDonasi.'%');
            })
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

        $totalZakat = $this->getSaldoSumberDonasi($this->selectedTahun, 'Zakat');

        $totalInfaq = $this->getSaldoSumberDonasi($this->selectedTahun, 'Infaq');

        $totalAmil = $this->getSaldoSumberDonasi($this->selectedTahun, 'Amil');

        $totalZakatInfaq = $totalZakat + $totalInfaq;

        $totalSemua = $totalZakatInfaq + $totalAmil;

        return view('livewire.dashboard.table-saldo', compact(
            'totalZakat',
            'totalInfaq',
            'totalAmil',
            'totalZakatInfaq',
            'totalSemua',
        ));
    }
}
