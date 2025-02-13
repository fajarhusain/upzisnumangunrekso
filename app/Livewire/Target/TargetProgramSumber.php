<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetProgramSumber as ModelTargetProgramSumber;
use Livewire\Attributes\Reactive;

class TargetProgramSumber extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun = $tahun;
    }

    public function render()
    {
        $targetProgramSumbers = ModelTargetProgramSumber::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();

        return view('livewire.target.target-program-sumber', compact('targetProgramSumbers'));
    }
}
