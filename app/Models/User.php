<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'role',
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
            'password' => 'hashed',
        ];
    }

    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }

    public function isHrd(): bool
    {
        return $this->role === 'hrd';
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function profile(): HasOne
    {
        return $this->hasOne(ApplicantProfile::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ApplicantAnswer::class);
    }

    public function sawResults(): HasMany
    {
        return $this->hasMany(SawResult::class)->orderBy('rank', 'asc');
    }

    public function application(): HasOne
    {
        return $this->hasOne(Application::class);
    }
}
