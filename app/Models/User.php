<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Only allow specific admin emails to access the Filament panel.
     * Add additional emails to the array as needed.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        $allowedEmails = array_filter(
            explode(',', env('APP_ADMIN_EMAILS', $this->email)),
            fn ($e) => filled(trim($e))
        );

        return in_array($this->email, array_map('trim', $allowedEmails), true);
    }
}
