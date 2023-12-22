<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $this->belongsTo(User::class);
    }

    public function doctor()
    {
        $this->belongsTo(Doctor::class);
    }

    public function files()
    {
        $this->hasMany(file::class);
    }
}
