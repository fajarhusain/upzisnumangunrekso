<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'pindahdana' => 'boolean',
    ];

    /**
     * Get the pemenimaManfaat that owns the Penyaluran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ashnaf()
    {
        return $this->belongsTo(Ashnaf::class);
    }

    public function programPilar()
    {
        return $this->belongsTo(ProgramPilar::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }

    public function sumberDana()
    {
        return $this->belongsTo(SumberDana::class);
    }

    public function programSumber()
    {
        return $this->belongsTo(ProgramSumber::class);
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
