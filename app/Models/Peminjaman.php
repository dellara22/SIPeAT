<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = [
        'pemohon',
        'ruangan',
        'tanggal',
        'status',
        'surat',
        'deskripsi',
        'kegiatan',
        'addedby'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan', 'id');
    }
}
