<?php

namespace App\Livewire\Dashboard;

use App\Models\Pilar;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\TargetTahunan;
use Livewire\Attributes\Reactive;

class TableTasyaruf extends Component
{
    #[Reactive]
    public $selectedTahun;

    public $pilars;

    public function mount($selectedTahun)
    {
        $this->selectedTahun = $selectedTahun;
        $this->pilars = Pilar::query()->get();
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        $targetselectedTahun = TargetTahunan::query()
            ->where('tahun_id', $this->selectedTahun)
            ->where('jenis', 'penyaluran')
            ->sum('nominal');

        return view('livewire.dashboard.table-tasyaruf', compact(
            'targetselectedTahun',
        ));
    }
}
