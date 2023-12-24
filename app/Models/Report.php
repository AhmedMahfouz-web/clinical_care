<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'profession',
        'family_related',
        'sleep_on_hospital',
        'surgery',
        'notes',
        'doctor_id',
        'doctor_comment',
        'user_id',
        'transaction'
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(file::class);
    }
}
