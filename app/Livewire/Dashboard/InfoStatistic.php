<?php

namespace App\Livewire\Dashboard;

use App\Models\Penghimpunan;
use App\Models\Penyaluran;
use Livewire\Component;

class InfoStatistic extends Component
{
    public function render()
    {
        $tunaiZakatPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Tunai');
            })
            ->sum('nominal');
        $tunaiZakatPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Tunai');
            })
            ->sum('nominal');
        $saldoTunaiZakat = $tunaiZakatPenghimpunan - $tunaiZakatPenyaluran;

        $bsiZakatPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BSI Zakat');
            })
            ->sum('nominal');
        $bsiZakatPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BSI Zakat');
            })
            ->sum('nominal');
        $saldoBsiZakat = $bsiZakatPenghimpunan - $bsiZakatPenyaluran;

        $bpddiyZakatPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BPDDIY Zakat');
            })
            ->sum('nominal');
        $bpddiyZakatPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Zakat');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BPDDIY Zakat');
            })
            ->sum('nominal');
        $saldoBpddiyZakat = $bpddiyZakatPenghimpunan - $bpddiyZakatPenyaluran;

        $tunaiInfaqPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Tunai');
            })
            ->sum('nominal');
        $tunaiInfaqPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Tunai');
            })
            ->sum('nominal');
        $saldoTunaiInfaq = $tunaiInfaqPenghimpunan - $tunaiInfaqPenyaluran;

        $bsiInfaqPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BSI Infaq');
            })
            ->sum('nominal');
        $bsiInfaqPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BSI Infaq');
            })
            ->sum('nominal');
        $saldoBsiInfaq = $bsiInfaqPenghimpunan - $bsiInfaqPenyaluran;

        $bpddiyInfaqPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BPDDIY Infaq');
            })
            ->sum('nominal');
        $bpddiyInfaqPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'BPDDIY Infaq');
            })
            ->sum('nominal');
        $saldoBpddiyInfaq = $bpddiyInfaqPenghimpunan - $bpddiyInfaqPenyaluran;

        $muamalatInfaqPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Muamalat Infaq');
            })
            ->sum('nominal');
        $muamalatInfaqPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Muamalat Infaq');
            })
            ->sum('nominal');
        $saldoMuamalatInfaq = $muamalatInfaqPenghimpunan - $muamalatInfaqPenyaluran;

        $madinaInfaqPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Madina Infaq');
            })
            ->sum('nominal');
        $madinaInfaqPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Infaq');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Madina Infaq');
            })
            ->sum('nominal');
        $saldoMadinaInfaq = $madinaInfaqPenghimpunan - $madinaInfaqPenyaluran;

        $bankAmilPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Bank');
            })
            ->sum('nominal');
        $bankAmilPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Bank');
            })
            ->sum('nominal');
        $saldoBankAmil = $bankAmilPenghimpunan - $bankAmilPenyaluran;

        $besarAmilPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Besar');
            })
            ->sum('nominal');
        $besarAmilPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Besar');
            })
            ->sum('nominal');
        $saldoBesarAmil = $besarAmilPenghimpunan - $besarAmilPenyaluran;

        $kecilAmilPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Kecil');
            })
            ->sum('nominal');
        $kecilAmilPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Kecil');
            })
            ->sum('nominal');
        $saldoKecilAmil = $kecilAmilPenghimpunan - $kecilAmilPenyaluran;

        $madinaAmilPenghimpunan = Penghimpunan::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Bank Madina');
            })
            ->sum('nominal');
        $madinaAmilPenyaluran = Penyaluran::query()
            ->whereHas('programSumber', function ($query) {
                $query->whereHas('sumberDonasi', function ($query) {
                    $query->where('name', 'Amil');
                });
            })
            ->whereHas('sumberDana', function ($query) {
                $query->where('name', 'Amil Bank Madina');
            })
            ->sum('nominal');
        $saldoMadinaAmil = $madinaAmilPenghimpunan - $madinaAmilPenyaluran;

        $totalZakat = $saldoTunaiZakat + $saldoBsiZakat + $saldoBpddiyZakat;

        $totalInfaq = $saldoTunaiInfaq + $saldoBsiInfaq + $saldoBpddiyInfaq + $saldoMuamalatInfaq + $saldoMadinaInfaq;

        $totalAmil = $saldoBankAmil + $saldoBesarAmil + $saldoKecilAmil + $saldoMadinaAmil;

        $totalZakatInfaq = $totalZakat + $totalInfaq;

        $totalSemua = $totalZakatInfaq + $totalAmil;

        return view('livewire.dashboard.info-statistic', compact(
            'saldoTunaiZakat',
            'saldoBsiZakat',
            'saldoBpddiyZakat',
            'saldoTunaiInfaq',
            'saldoBsiInfaq',
            'saldoBpddiyInfaq',
            'saldoMadinaInfaq',
            'saldoMuamalatInfaq',
            'saldoBankAmil',
            'saldoBesarAmil',
            'saldoKecilAmil',
            'saldoMadinaAmil',
            'totalZakat',
            'totalInfaq',
            'totalAmil',
            'totalZakatInfaq',
            'totalSemua',
        ));
    }
}
