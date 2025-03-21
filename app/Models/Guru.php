<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Guru extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'gurus';

    protected $fillable = [
        'id_guru', 'nip', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama'
    ];

    public $incrementing = false; // UUID bukan auto-increment
    protected $keyType = 'string'; // UUID menggunakan string
}