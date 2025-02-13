<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSumber extends Model
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

    public function targetProgramSumbers()
    {
        return $this->hasMany(TargetProgramSumber::class);
    }

    public function sumberDonasi()
    {
        return $this->belongsTo(SumberDonasi::class);
    }
}
