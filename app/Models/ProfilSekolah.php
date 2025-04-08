<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';
    protected $primaryKey = 'id_profil';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'npsn',
        'alamat_sekolah',
        'email',
        'website',
        'telepon',
        'tahun_pelajaran',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id_profil) {
                $model->id_profil = (string) Str::uuid();
            }
        });
    }
}

