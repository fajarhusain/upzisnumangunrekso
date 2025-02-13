<?php

namespace App\Livewire\Dashboard;

use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use App\Models\TargetProgramSumber;
use App\Models\TargetSubInfaq;
use App\Models\TargetSumberDonasi;
use App\Models\TargetTahunan as ModelTargetTahunan;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class TableFundraising extends Component
{
    #[Reactive]
    public $selectedTahun;

    public $proSum;

    public $sumberZakats;

    public $sumberInfaqNonRutins;

    public $sumberInfaqRutins;

    public function mount($selectedTahun)
    {
        $this->$selectedTahun = $selectedTahun;

        $this->sumberZakats = ProgramSumber::query()
            ->whereHas('sumberDonasi', function ($query) {
                $query->where('name', 'Zakat');
            })
            ->get()
            ->map(function ($item, $key) {
                $item->setAttribute('index', $key + 1); // Tambahkan indeks secara manual

                return $item;
            });

        $this->sumberInfaqNonRutins = ProgramSumber::query()
            ->whereHas('sumberDonasi', function ($query) {
                $query->where('name', 'Infaq');
            })
            ->where('name', 'not like', '%Pot Infaq%')
            ->get()
            ->map(function ($item, $key) {
                $item->setAttribute('index', $key + 1); // Tambahkan indeks secara manual

                return $item;
            });

        $this->sumberInfaqRutins = ProgramSumber::query()
            ->whereHas('sumberDonasi', function ($query) {
                $query->where('name', 'Infaq');
            })
            ->where('name', 'like', '%Pot Infaq%')
            ->get()
            ->map(function ($item, $key) {
                $item->setAttribute('index', $key + 1); // Tambahkan indeks secara manual

                return $item;
            });
    }

    public function updatedSelectedTahun()
    {
        $this->dispatch('updateTable');
    }

    #[On('updatedTable')]
    public function render()
    {
        $targetselectedTahun = ModelTargetTahunan::query()
            ->where('tahun_id', $this->selectedTahun)
            ->where('jenis', 'penghimpunan')
            ->sum('nominal');

        $targetPersenZakat = TargetSumberDonasi::query()
            ->whereHas('sumberDonasi', function ($query) {
                $query->where('name', 'zakat');
            })
            ->where('tahun_id', $this->selectedTahun)
            ->sum('nominal');

        $targetPersenInfaq = TargetSumberDonasi::query()
            ->whereHas('sumberDonasi', function ($query) {
                $query->where('name', 'infaq');
            })
            ->where('tahun_id', $this->selectedTahun)
            ->sum('nominal');

        $targetPersenInfaqNR = TargetSubInfaq::query()
            ->where('tahun_id', $this->selectedTahun)
            ->where('jenis', 'infaqnonrutin')
            ->sum('nominal');

        $targetPersenInfaqR = TargetSubInfaq::query()
            ->where('tahun_id', $this->selectedTahun)
            ->where('jenis', 'infaqrutin')
            ->sum('nominal');

        $nominalTargetZakat = ($targetselectedTahun * $targetPersenZakat) / 100;
        $nominalTargetInfaq = ($targetselectedTahun * $targetPersenInfaq) / 100;
        $nominalTargetInfaqNonRutin = ($nominalTargetInfaq * $targetPersenInfaqNR) / 100;
        $nominalTargetInfaqRutin = ($nominalTargetInfaq * $targetPersenInfaqR) / 100;

        $totalRealisasiZakat = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->where('tahun_id', $this->selectedTahun)
            ->where('pindahdana', false)
            ->sum('nominal');

        $totalRealisasiInfaqNonRutin = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                })
                    ->where('name', 'not like', '%Pot Infaq%');
            })
            ->where('tahun_id', $this->selectedTahun)
            ->where('pindahdana', false)
            ->sum('nominal');

        $totalRealisasiInfaqRutin = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                })
                    ->where('name', 'like', '%Pot Infaq%');
            })
            ->where('tahun_id', $this->selectedTahun)
            ->where('pindahdana', false)
            ->sum('nominal');

        $totalRealisasiInfaq = $totalRealisasiInfaqNonRutin + $totalRealisasiInfaqRutin;
        $totalRealisasiZakatInfaq = $totalRealisasiZakat + $totalRealisasiInfaq;

        $persenRealisasiZakat = $nominalTargetZakat == 0 ? 0 : ($totalRealisasiZakat / $nominalTargetZakat) * 100;
        $persenRealisasiInfaq = $nominalTargetInfaq == 0 ? 0 : ($totalRealisasiInfaq / $nominalTargetInfaq) * 100;
        $persenRealisasiInfaqNonRutin = $nominalTargetInfaqNonRutin == 0 ? 0 : ($totalRealisasiInfaqNonRutin / $nominalTargetInfaqNonRutin) * 100;
        $persenRealisasiInfaqRutin = $nominalTargetInfaqRutin == 0 ? 0 : ($totalRealisasiInfaqRutin / $nominalTargetInfaqRutin) * 100;

        $pembulatanPersenRealisaiZakat = round($persenRealisasiZakat, 3);
        $pembulatanPersenRealisaiInfaq = round($persenRealisasiInfaq, 3);
        $pembulatanPersenRealisaiInfaqNonRutin = round($persenRealisasiInfaqNonRutin, 3);
        $pembulatanPersenRealisaiInfaqRutin = round($persenRealisasiInfaqRutin, 3);

        return view('livewire.dashboard.table-fundraising', compact(
            'targetselectedTahun',
            'targetPersenZakat',
            'targetPersenInfaq',
            'targetPersenInfaqNR',
            'targetPersenInfaqR',
            'nominalTargetZakat',
            'nominalTargetInfaq',
            'nominalTargetInfaqNonRutin',
            'nominalTargetInfaqRutin',
            'totalRealisasiZakat',
            'totalRealisasiInfaqNonRutin',
            'totalRealisasiInfaqRutin',
            'totalRealisasiInfaq',
            'totalRealisasiZakatInfaq',
            'pembulatanPersenRealisaiZakat',
            'pembulatanPersenRealisaiInfaq',
            'pembulatanPersenRealisaiInfaqNonRutin',
            'pembulatanPersenRealisaiInfaqRutin',

        ));
    }
}
