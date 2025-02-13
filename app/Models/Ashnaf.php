<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ashnaf extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function penyalurans()
    {
        return $this->hasMany(Penyaluran::class);
    }
}
