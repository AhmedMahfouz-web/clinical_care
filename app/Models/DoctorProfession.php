<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProfession extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'profession_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
