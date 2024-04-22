<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKriteria extends Model
{
    use HasFactory;
    protected $table = 'detail_kriteria';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }
}
