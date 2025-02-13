<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetProgramPilar extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

    public function programPilar()
    {
        return $this->belongsTo(ProgramPilar::class);
    }
}
