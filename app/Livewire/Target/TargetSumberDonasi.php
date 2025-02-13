<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetSumberDonasi as ModelTargetSumberDonasi;
use Livewire\Attributes\Reactive;

class TargetSumberDonasi extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun = $tahun;
    }

    public function render()
    {
        $targetSumberDonasis = ModelTargetSumberDonasi::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();

        return view('livewire.target.target-sumber-donasi', compact('targetSumberDonasis'));
    }
}
