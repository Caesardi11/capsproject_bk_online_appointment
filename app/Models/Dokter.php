<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Dokter extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'dokter';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'id_akun',
        'id_poli',
        'alamat',
        'no_hp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_akun', 'id');
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function jadwal_periksa()
    {
        return $this->hasMany(jadwal_periksa::class, 'id_dokter');
    }
}
