<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'name',
        'status',
        'thumbnail',
        'deskripsi',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'ruangan', 'id');
    }
}
