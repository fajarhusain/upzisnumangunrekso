<?php

namespace App\Livewire\Target;

use App\Models\Tahun;
use Livewire\Component;
use Illuminate\Support\Carbon;

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

    public function render()
    {
        return view('livewire.target.index');
    }
}
