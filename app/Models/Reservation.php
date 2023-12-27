<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Test;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hospital_id',
        'test_id',
        'date',
        'status',
        'transaction',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
