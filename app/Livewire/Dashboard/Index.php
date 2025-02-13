<?php

namespace App\Livewire\Dashboard;

use App\Models\Tahun;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $tahuns;

    public $selectedTahun;

    public function mount()
    {
        $this->tahuns = Tahun::query()->get();

        $this->selectedTahun = Tahun::query()
            ->where('name', Carbon::now()->year)
            ->first()->id;
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
