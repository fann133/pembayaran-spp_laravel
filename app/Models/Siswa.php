<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas'; // Nama tabel

    protected $primaryKey = 'id_siswa'; // Primary Key

    public $incrementing = false; // Non-incrementing (karena pakai UUID)

    protected $keyType = 'string'; // UUID menggunakan string

    protected $fillable = [
        'id_siswa', 'nama', 'nis', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id_siswa = Str::uuid(); // Generate UUID saat membuat data baru
        });
    }
}

