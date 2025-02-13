<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilar extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function programPilars()
    {
        return $this->hasMany(ProgramPilar::class);
    }

    public function targetPilars()
    {
        return $this->hasMany(TargetPilar::class);
    }
}
