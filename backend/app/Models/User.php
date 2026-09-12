<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_photo',
        'bio',
        'experience_years',
        'service_area',
        'is_available',
        'is_active',
        'rating',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_available' => 'boolean',
            'is_active' => 'boolean',
            'rating' => 'decimal:2',
            'experience_years' => 'integer',
        ];
    }

    // Role checks
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTechnician(): bool
    {
        return $this->role === 'technician';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    // Relationships
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function customerRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'customer_id');
    }

    public function technicianRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class, 'technician_id');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'technician_skills', 'technician_id', 'category_id')->withTimestamps();
    }

    public function reviewsAsCustomer(): HasMany
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    public function reviewsAsTechnician(): HasMany
    {
        return $this->hasMany(Review::class, 'technician_id');
    }
}
