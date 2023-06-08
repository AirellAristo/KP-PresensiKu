<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_company';
    protected $fillable = [
                'id_company',
                'company_name',
    ];
}
