<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeSalary extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_salaries';

    protected $fillable = [
        'id_user',
        'total_gaji',
        'bukti_transfer_gaji',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
