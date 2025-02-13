<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghimpunan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'pindahdana' => 'boolean'
    ];

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class);
    }

    public function programSumber()
    {
        return $this->belongsTo(ProgramSumber::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
