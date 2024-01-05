<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $table = 'poli';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nama_poli',
        'keterangan'
    ];
}
