<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['id_akun', 'nama', 'alamat', 'no_ktp', 'no_hp', 'no_rm'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_akun', 'id');
    }
}
