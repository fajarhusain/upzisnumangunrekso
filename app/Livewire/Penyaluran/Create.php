<?php

namespace App\Livewire\Penyaluran;

use App\Models\Ashnaf;
use App\Models\Kabupaten;
use App\Models\Penghimpunan;
use App\Models\Penyaluran;
use App\Models\Pilar;
use App\Models\ProgramPilar;
use App\Models\ProgramSumber;
use App\Models\Provinsi;
use App\Models\SumberDana;
use App\Models\SumberDonasi;
use App\Models\Tahun;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate]
    public $tanggal;

    public Collection $tahuns;

    public $selectedTahun;

    public $provinsis;

    public $selectedProvinsi;

    public Collection $kabupatens;

    public $selectedKabupaten;

    public $uraian;

    public $ashnafs;

    public $selectedAshnaf;

    public $lembaga;

    public $pria;

    public $wanita;

    public $pilars;

    public $selectedPilar;

    public Collection $programPilars;

    public $selectedProgramPilar;

    public $sumberDanas;

    public $selectedSumberDana;

    public $programSumbers;

    public $selectedProgramSumber;

    public $sumberDonasis;

    public $selectedSumberDonasi;

    public $nominal;

    public $currentSaldo;

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
        $this->provinsis = Provinsi::query()->get();
        // $this->kabupatens = Kabupaten::query()->get();
        $this->ashnafs = Ashnaf::query()->get();
        $this->pilars = Pilar::query()->get();
        // $this->programPilars = ProgramPilar::query()->get();
        $this->sumberDanas = SumberDana::query()->get();
        $this->programSumbers = ProgramSumber::query()->get();
        $this->sumberDonasis = SumberDonasi::query()->get();
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
            'selectedSumberDonasi' => 'nullable|exists:sumber_donasis,id',
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

    public function getSaldo($selectedTahun, $sumberDana, $sumberDonasi)
    {
        $tunaiSaldoPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->where('sumber_donasi_id', $sumberDonasi);
            })
            ->where('sumber_dana_id', $sumberDana)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');

        $tunaiSaldoPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) use ($sumberDonasi) {
                $query->where('sumber_donasi_id', $sumberDonasi);
            })
            ->where('sumber_dana_id', $sumberDana)
            ->where('tahun_id', $selectedTahun)
            ->sum('nominal');

        return $tunaiSaldoPenghimpunan - $tunaiSaldoPenyaluran;
    }

    public function updatedSelectedSumberDana()
    {
        $this->currentSaldo = $this->getSaldo($this->selectedTahun, $this->selectedSumberDana, $this->selectedSumberDonasi);
    }

    public function parseRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp.\s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }

    public function createPenyaluran()
    {

        $validated = $this->validate();
        // Remove any non-numeric characters for safe storage as integer
        $nominal = $this->parseRupiah($this->nominal);
        // dd($this->nominal);

        Penyaluran::create([
            'tanggal' => $this->tanggal,
            'uraian' => $this->uraian,
            'program_sumber_id' => $this->selectedProgramSumber,
            'sumber_dana_id' => $this->selectedSumberDana,
            'nominal' => $nominal,
            'pilar_id' => $this->selectedPilar,
            'program_pilar_id' => $this->selectedProgramPilar,
            'ashnaf_id' => $this->selectedAshnaf,
            'lembaga_count' => $this->lembaga == null || $this->lembaga == '' ? 0 : $this->lembaga,
            'male_count' => $this->pria == null || $this->pria == '' ? 0 : $this->pria,
            'female_count' => $this->wanita == null || $this->wanita == '' ? 0 : $this->wanita,
            'provinsi_id' => $this->selectedProvinsi,
            'kabupaten_id' => $this->selectedKabupaten,
            'tahun_id' => $this->selectedTahun,
            'lampiran' => $this->lampiran,
            'pindahdana' => $this->isPindahDana == null ? false : $this->isPindahDana,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('penyaluran.index');
    }

    public function render()
    {
        return view('livewire.penyaluran.create');
    }
}
