<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_tagihan', 'id_siswa', 'nama', 'nis', 'kelas', 'tahun_pelajaran', 'kode', 'id_biaya', 
        'nama_pembayaran', 'jenis', 'jumlah', 'bulan', 'status', 'tanggal_tagihan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kelas()
    {
        return $this->hasOneThrough(Kelas::class, Siswa::class, 'id_siswa', 'id_kelas', 'id_siswa', 'id_kelas');
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'id_biaya', 'id_biaya');
    }

    protected static function boot()
    {
        parent::boot();

        // Generate UUID sebelum membuat tagihan baru
        static::creating(function ($tagihan) {
            $tagihan->id_tagihan = (string) Str::uuid();
        });
    }


}

