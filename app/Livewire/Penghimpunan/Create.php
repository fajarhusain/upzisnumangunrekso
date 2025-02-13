<?php

namespace App\Livewire\Penghimpunan;

use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $tanggal;

    public $tahuns;

    public $selectedTahun;

    public $uraian;

    public $nominal;

    public $lembaga;

    public $pria;

    public $wanita;

    public $noname;

    public $sumberDonasis;

    public $selectedSumberDonasi;

    public $programSumbers;

    public $selectedProgramSumber;

    public $sumberDanas;

    public $selectedSumberDana;

    public $isPindahDana;

    public $lampiran;

    public function mount()
    {
        $this->tanggal = Carbon::now()->format('Y-m-d');
        $this->tahuns = Tahun::query()->get();
        // query to find the record in Tahun where 'tahun' matches the current year
        $this->selectedTahun = Tahun::query()
            ->where('name', Carbon::now()->year)
            ->first()->id;
        $this->sumberDonasis = SumberDonasi::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDanas = SumberDana::query()->get();

    }

    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'uraian' => 'required|max:65535',
            'nominal' => 'required',
            'lembaga' => 'nullable|numeric|min:0',
            'pria' => 'nullable|numeric|min:0',
            'wanita' => 'nullable|numeric|min:0',
            'noname' => 'nullable|numeric|min:0',
            'selectedSumberDonasi' => 'required|exists:sumber_donasis,id',
            'selectedProgramSumber' => 'required|exists:program_sumbers,id',
            'selectedSumberDana' => 'required|exists:sumber_danas,id',
            'selectedTahun' => 'required|exists:tahuns,id',
            'lampiran' => 'nullable|url:http,https',
            'isPindahDana' => 'nullable|boolean',
        ];

    }

    public function updatedSelectedSumberDonasi()
    {
        $this->programSumbers = ProgramSumber::query()->where('sumber_donasi_id', $this->selectedSumberDonasi)->get();
        $this->reset('selectedProgramSumber');
    }

    public function parseRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp.\s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }

    public function createPenghimpunan()
    {
        $this->validate();

        // Remove any non-numeric characters for safe storage as integer
        $numnominal = $this->parseRupiah($this->nominal);

        Penghimpunan::create([
            'tanggal' => $this->tanggal,
            'uraian' => $this->uraian,
            'nominal' => $numnominal,
            'lembaga_count' => $this->lembaga == null || $this->lembaga == '' ? 0 : $this->lembaga,
            'male_count' => $this->pria == null || $this->pria == '' ? 0 : $this->pria,
            'female_count' => $this->wanita == null || $this->wanita == '' ? 0 : $this->wanita,
            'no_name_count' => $this->noname == null || $this->noname == '' ? 0 : $this->noname,
            'program_sumber_id' => $this->selectedProgramSumber,
            'sumber_dana_id' => $this->selectedSumberDana,
            'tahun_id' => $this->selectedTahun,
            'pindahdana' => $this->isPindahDana == null ? false : $this->isPindahDana,
            'user_id' => auth()->user()->id,
            'lampiran' => $this->lampiran,
        ]);

        return redirect()->route('penghimpunan.index')->with('success', 'Penghimpunan created successfully!');

    }

    public function render()
    {
        return view('livewire.penghimpunan.create');
    }
}
