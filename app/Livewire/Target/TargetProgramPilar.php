<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetProgramPilar as ModelTargetProgramPilar;
use Livewire\Attributes\Reactive;

class TargetProgramPilar extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun = $tahun;
    }

    public function render()
    {
        $targetProgramPilars = ModelTargetProgramPilar::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();

        return view('livewire.target.target-program-pilar', compact('targetProgramPilars'));
    }
}
