<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Guru extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'gurus';
    protected $primaryKey = 'id_guru'; 
    public $incrementing = false; // UUID bukan auto-increment
    protected $keyType = 'string'; // UUID menggunakan string

    protected $fillable = [
        'id_guru',
        'users_id',
        'nip',
        'nama', 
        'jenis_kelamin', 
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status', 
        'role_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id_guru = Str::uuid(); // Generate UUID untuk setiap guru yang dibuat
        });

        // Saat menghapus guru, hapus juga user yang terkait
        static::deleting(function ($guru) {
            if ($guru->users_id) {
                User::where('id_users', $guru->users_id)->delete();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id_users');
    }
}