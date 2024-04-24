<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function detail_penduduk()
    {
        return $this->hasMany(DetailPenduduk::class, 'id_penduduk', 'id_penduduk');
    }

    public function training()
    {
        return $this->hasOne(Training::class, 'id_penduduk', 'id_penduduk');
    }
}
