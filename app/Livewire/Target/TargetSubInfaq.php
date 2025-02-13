<?php

namespace App\Livewire\Target;

use Livewire\Component;
use App\Models\TargetSubInfaq as ModelTargetSubInfaq;
use Livewire\Attributes\Reactive;

class TargetSubInfaq extends Component
{
    #[Reactive]
    public $tahun;

    public function mount($tahun)
    {
        $this->tahun;
    }

    public function render()
    {
        $targetsubinfaqs = ModelTargetSubInfaq::when($this->tahun, function ($query) {
            $query->where('tahun_id', $this->tahun);
        })->get();
        return view('livewire.target.target-sub-infaq', compact('targetsubinfaqs'));
    }
}
