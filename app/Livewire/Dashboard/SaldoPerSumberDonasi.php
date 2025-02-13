<?php

namespace App\Livewire\Dashboard;

use App\Models\Penghimpunan;
use App\Models\Penyaluran;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SaldoPerSumberDonasi extends Component
{
    #[Reactive]
    public $selectedTahun;

    #[Reactive]
    public $sumberDonasi;

    public $sumberDanas;

    public function mount($selectedTahun, $sumberDonasi)
    {
        $this->selectedTahun = $selectedTahun;
        $this->sumberDonasi = $sumberDonasi;
        $this->sumberDanas = SumberDana::query()
            ->where('name', 'like', '%'.$this->sumberDonasi->name.'%')
            ->get()
            ->map(function ($item, $key) {
                $item->setAttribute('index', $key + 1); // Tambahkan indeks secara manual

                return $item;
            });
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        return view('livewire.dashboard.saldo-per-sumber-donasi');
    }
}
