<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'mulai',
        'akhir',
        'keterangan',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }
}
