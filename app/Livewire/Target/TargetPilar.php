<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetPilar as ModelTargetPilar;
use Livewire\Attributes\Reactive;

class TargetPilar extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun = $tahun;
    }

    public function render()
    {
        $targetpilars = ModelTargetPilar::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();

        return view('livewire.target.target-pilar', compact('targetpilars'));
    }
}
