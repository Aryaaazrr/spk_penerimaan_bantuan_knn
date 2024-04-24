<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $table = 'data_training';
    protected $primaryKey = 'id_training';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id_penduduk');
    }
}