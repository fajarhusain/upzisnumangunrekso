<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetTahunan as ModelTargetTahunan;
use Livewire\Attributes\Reactive;

class TargetTahunan extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun = $tahun;
    }

    public function render()
    {
        $targetTahunans = ModelTargetTahunan::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();

        return view('livewire.target.target-tahunan', compact('targetTahunans'));
    }
}
