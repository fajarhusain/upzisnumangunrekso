<?php

namespace App\Livewire\Penghimpunan;

use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    public ?Penghimpunan $penghimpunan;

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

    public $lampiran;

    public $isPindahDana;

    public function mount(Penghimpunan $penghimpunan)
    {
        $this->tahuns = Tahun::query()->get();
        $this->sumberDonasis = SumberDonasi::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDanas = SumberDana::query()->get();

        $this->penghimpunan = $penghimpunan;

        $this->tanggal = Carbon::parse($penghimpunan->tanggal)->format('Y-m-d');
        $this->uraian = $penghimpunan->uraian;
        $this->nominal = $penghimpunan->nominal;
        $this->lembaga = $penghimpunan->lembaga_count;
        $this->pria = $penghimpunan->male_count;
        $this->wanita = $penghimpunan->female_count;
        $this->noname = $penghimpunan->no_name_count;
        $this->selectedSumberDonasi = $penghimpunan->programSumber->sumberDonasi->id;
        $this->selectedProgramSumber = $penghimpunan->programSumber->id;
        $this->selectedSumberDana = $penghimpunan->sumberDana->id;
        $this->selectedTahun = $penghimpunan->tahun->id;
        $this->lampiran = $penghimpunan->lampiran;
        $this->isPindahDana = $penghimpunan->pindahdana;

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

    public function updatePenghimpunan()
    {
        $this->validate();

        // Remove any non-numeric characters for safe storage as integer
        $numnominal = $this->parseRupiah($this->nominal);
        // dd($this->lembaga);
        $this->penghimpunan->update([
            'tanggal' => $this->tanggal,
            'uraian' => $this->uraian,
            'nominal' => $numnominal,
            'lembaga_count' => $this->lembaga == '' ? 0 : $this->lembaga,
            'male_count' => $this->pria == '' ? 0 : $this->pria,
            'female_count' => $this->wanita == '' ? 0 : $this->wanita,
            'no_name_count' => $this->noname == '' ? 0 : $this->noname,
            'program_sumber_id' => $this->selectedProgramSumber,
            'sumber_dana_id' => $this->selectedSumberDana,
            'tahun_id' => $this->selectedTahun,
            'pindahdana' => $this->isPindahDana == null ? false : $this->isPindahDana,
            'lampiran' => $this->lampiran,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('penghimpunan.index')->with('success', 'Penghimpunan created successfully!');

    }

    public function render()
    {
        return view('livewire.penghimpunan.edit');
    }
}
