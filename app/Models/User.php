<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Statamic\Notifications\PasswordReset;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'property_number',
        'street_name',
        'postal_code',
        'city',
        'payment_status',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'balance' => 'decimal:2',
            'preferences' => 'json',
            'is_admin' => 'boolean',
        ];
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordReset($token));
    }

    public function waterValves(): HasOne
    {
        return $this->hasOne(WaterValve::class);
    }

    public function getTranslatedPaymentStatusAttribute(): string
    {
        return match ($this->payment_status) {
            'paid' => 'Betald',
            'unpaid' => 'Obetald',
            'overdue' => 'Förfallen',
            default => 'Okänd status',
        };
    }

    public function getPaymentStatusColorAttribute(): string
    {
        return match ($this->payment_status) {
            'paid' => 'bg-green-100 border border-green-300 text-green-900',
            'unpaid' => 'bg-red-100 border border-red-300 text-red-900',
            'overdue' => 'bg-yellow-800/20 text-yellow-900',
            default => 'bg-gray-800/20 text-gray-900',
        };
    }

    /* public function payments() */
    /* { */
    /*     return $this->hasMany(Payment::class); */
    /* } */
}
