<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',      // Nama hewan
        'jenis',     // Jenis hewan
        'usia',      // Usia hewan
        'kondisi',   // Kondisi hewan
        'foto',      // Foto hewan
        'pemilik_id' // ID pemilik hewan (relasi ke tabel Akun)
    ];

    public function pemilik()
    {
        return $this->belongsTo(Akun::class, 'pemilik_id');
    }
}
