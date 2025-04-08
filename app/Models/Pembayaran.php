<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pembayaran', 'id_users', 'id_tagihan', 'id_siswa', 
        'nama', 'nis', 'kelas', 'kode', 'nama_pembayaran', 'jenis', 
        'bulan', 'jumlah_tagihan', 'dibayar', 'piutang', 
        'status', 'tanggal_bayar'
    ];
    
    

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id_pembayaran = Str::uuid();
        });
    }
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }


}
