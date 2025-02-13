<?php

namespace App\Livewire\Penyaluran;

use App\Models\Ashnaf;
use App\Models\Kabupaten;
use App\Models\Penyaluran;
use App\Models\Pilar;
use App\Models\ProgramPilar;
use App\Models\ProgramSumber;
use App\Models\Provinsi;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    #[Validate]
    public $penyaluran;

    public $tanggal;

    public $tahuns;

    public $selectedTahun;

    public $provinsis;

    public $selectedProvinsi;

    public $kabupatens;

    public $selectedKabupaten;

    public $uraian;

    public $ashnafs;

    public $selectedAshnaf;

    public $lembaga;

    public $pria;

    public $wanita;

    public $pilars;

    public $selectedPilar;

    public $programPilars;

    public $selectedProgramPilar;

    public $sumberDanas;

    public $selectedSumberDana;

    public $programSumbers;

    public $selectedProgramSumber;

    public $sumberDonasis;

    public $selectedSumberDonasi;

    public $nominal;

    public $isPindahDana;

    public $lampiran;

    public function mount(Penyaluran $penyaluran)
    {

        $this->tahuns = Tahun::query()->get();
        $this->sumberDonasis = SumberDonasi::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDanas = SumberDana::query()->get();
        $this->pilars = Pilar::query()->get();
        $this->programPilars = ProgramPilar::query()->get();
        $this->ashnafs = Ashnaf::query()->get();
        $this->provinsis = Provinsi::query()->get();
        $this->kabupatens = Kabupaten::query()->get();

        $this->penyaluran = $penyaluran;

        $this->tanggal = Carbon::parse($this->penyaluran->tanggal)->format('Y-m-d');
        $this->uraian = $penyaluran->uraian;
        $this->selectedSumberDonasi = $penyaluran->programSumber->sumberDonasi->id;
        $this->selectedProgramSumber = $penyaluran->programSumber->id;
        $this->selectedSumberDana = $penyaluran->sumberDana->id;
        $this->nominal = $penyaluran->nominal;
        $this->selectedPilar = $penyaluran->programPilar->pilar->id;
        $this->selectedProgramPilar = $penyaluran->programPilar->id;
        $this->selectedAshnaf = $penyaluran->ashnaf->id;
        $this->lembaga = $penyaluran->lembaga_count;
        $this->pria = $penyaluran->male_count;
        $this->wanita = $penyaluran->female_count;
        $this->selectedProvinsi = $penyaluran->kabupaten->provinsi->id;
        $this->selectedKabupaten = $penyaluran->kabupaten->id;
        $this->selectedTahun = $penyaluran->tahun->id;
        $this->lampiran = $penyaluran->lampiran;
        $this->isPindahDana = $penyaluran->pindahdana;

    }


    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'selectedTahun' => 'nullable|exists:tahuns,id',
            'selectedProvinsi' => 'nullable|exists:provinsis,id',
            'selectedKabupaten' => 'nullable|exists:kabupatens,id',
            'uraian' => 'required|max:65535',
            'selectedAshnaf' => 'nullable|exists:ashnafs,id',
            'lembaga' => 'nullable|numeric',
            'pria' => 'nullable|numeric',
            'wanita' => 'nullable|numeric',
            'selectedPilar' => 'nullable|exists:pilars,id',
            'selectedProgramPilar' => 'nullable|exists:program_pilars,id',
            'selectedSumberDana' => 'nullable|exists:sumber_danas,id',
            'selectedProgramSumber' => 'nullable|exists:program_sumbers,id',
            'selectedSumberDonasi' => 'required|exists:sumber_donasis,id',
            'lampiran' => 'nullable|url:http,https',
            'isPindahDana' => 'nullable|boolean',

        ];
    }

    public function updatedSelectedProvinsi()
    {
        $this->kabupatens = Kabupaten::query()->where('provinsi_id', $this->selectedProvinsi)->get();
        $this->reset('selectedKabupaten');

    }

    public function updatedSelectedPilar()
    {
        $this->programPilars = ProgramPilar::query()->where('pilar_id', $this->selectedPilar)->get();
        $this->reset('selectedProgramPilar');
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

    public function updatePenyaluran()
    {
        $validated = $this->validate();
        // Remove any non-numeric characters for safe storage as integer
        $nominal = $this->parseRupiah($this->nominal);
        // dd($this->nominal);

        $this->penyaluran->update([
            'tanggal' => $this->tanggal,
            'uraian' => $this->uraian,
            'nominal' => $nominal,
            'ashnaf_id' => $this->selectedAshnaf,
            'lembaga_count' => $this->lembaga == '' ? 0 : $this->lembaga,
            'male_count' => $this->pria == '' ? 0 : $this->pria,
            'female_count' => $this->wanita == '' ? 0 : $this->wanita,
            'pilar_id' => $this->selectedPilar,
            'program_pilar_id' => $this->selectedProgramPilar,
            'sumber_dana_id' => $this->selectedSumberDana,
            'program_sumber_id' => $this->selectedProgramSumber,
            'tahun_id' => $this->selectedTahun,
            'provinsi_id' => $this->selectedProvinsi,
            'kabupaten_id' => $this->selectedKabupaten,
            'user_id' => auth()->user()->id,
            'pindahdana' => $this->isPindahDana == null ? false : $this->isPindahDana,
            'lampiran' => $this->lampiran,

        ]);

        return redirect()->route('penyaluran.index');
    }

    public function render()
    {
        //dd($this->penyaluran);
        return view('livewire.penyaluran.edit');
    }
}
