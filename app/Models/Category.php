<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';

    public function finances()
    {
        return $this->hasMany(Finance::class, 'id_kategori');
    }
}
