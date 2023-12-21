<?php

namespace App\Models;

use App\Notifications\VerifyApiEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Doctor extends Authenticatable implements MustVerifyEmail, JWTSubject

{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'email', 'password', 'image', 'bio', 'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function professions()
    {
        return $this->belongsToMany(Profession::class, 'doctor_professions', 'doctor_id', 'profession_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmail);
    }
}
