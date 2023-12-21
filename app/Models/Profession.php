<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_professions', 'profession_id', 'doctor_id');
    }
}
