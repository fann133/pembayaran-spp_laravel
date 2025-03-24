<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_kelas', 'nama', 'kode_kelas', 'deskripsi', 'pengampu_kelas'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'pengampu_kelas', 'id_guru');
    }

    public function guruPengampu()
    {
        return $this->belongsTo(Guru::class, 'pengampu_kelas', 'id_guru');
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas', 'id_kelas');
    }
}

