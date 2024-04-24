<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenduduk extends Model
{
    use HasFactory;
    protected $table = 'detail_penduduk';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
    public function detail_kriteria()
    {
        return $this->belongsTo(DetailKriteria::class, 'id_subkriteria', 'id_subkriteria');
    }
}