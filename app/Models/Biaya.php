<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Biaya extends Model
{
    use HasFactory;

    protected $table = 'biaya';
    protected $primaryKey = 'id_biaya';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_biaya', 'nama', 'jenis', 'kode', 'deskripsi', 'jumlah', 'status', 'kategori'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($biaya) {
            $biaya->id_biaya = (string) Str::uuid();
        });
    }
}
