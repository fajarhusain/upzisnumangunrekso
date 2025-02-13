<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDonasi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function programSumbers()
    {
        return $this->hasMany(ProgramSumber::class);
    }

    public function targetSumberDonasis()
    {
        return $this->hasMany(TargetSumberDonasi::class);
    }
}
