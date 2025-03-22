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
        'id_siswa', 'nama', 'jenis_kelamin', 'nis', 'tempat_lahir', 'tanggal_lahir', 'kelas', 'status', 'users_id'
    ];

    protected static function boot()
    {
        parent::boot();

        // Saat membuat siswa, generate UUID
        static::creating(function ($model) {
            $model->id_siswa = Str::uuid();
        });

        // Saat menghapus siswa, hapus juga user yang terkait
        static::deleting(function ($siswa) {
            if ($siswa->users_id) {
                User::where('id_users', $siswa->users_id)->delete();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }

}

