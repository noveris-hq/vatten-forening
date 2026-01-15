<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $guard = 'members';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'property_number',
        'membership_status',
        'balance',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'balance' => 'decimal:2',
    ];

    public function payments()
    {
        /* return $this->hasMany(Payment::class); */
    }
}
