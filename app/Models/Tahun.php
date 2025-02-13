<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function penghimpunans()
    {
        return $this->hasMany(Penghimpunan::class);
    }

    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class);
    }

    public function targetTahunans()
    {
        return $this->hasMany(TargetTahunan::class);
    }

    public function targetSumberDonasis()
    {
        return $this->hasMany(TargetSumberDonasi::class);
    }

    public function targetProgramSumbers()
    {
        return $this->hasMany(TargetProgramSumber::class);
    }

    public function targetSubInfaqs()
    {
        return $this->hasMany(TargetSubInfaq::class);
    }

    public function targetPilars()
    {
        return $this->hasMany(TargetPilar::class);
    }

    public function targetProgramPilars()
    {
        return $this->hasMany(TargetProgramPilar::class);
    }
}
