<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'customer_id',
        'service_id',
        'technician_id',
        'address_id',
        'device_name',
        'device_brand',
        'device_model',
        'problem_description',
        'address',
        'latitude',
        'longitude',
        'preferred_date',
        'preferred_time',
        'status',
        'estimated_price',
        'final_price',
        'customer_notes',
        'technician_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'estimated_price' => 'decimal:2',
        'final_price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Status transition rules
    public const ALLOWED_TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['technician_assigned', 'cancelled'],
        'technician_assigned' => ['technician_on_the_way', 'cancelled'],
        'technician_on_the_way' => ['diagnosing', 'cancelled'],
        'diagnosing' => ['waiting_customer_approval', 'cancelled'],
        'waiting_customer_approval' => ['repairing', 'cancelled'],
        'repairing' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function canTransitionTo(string $newStatus): bool
    {
        $allowed = self::ALLOWED_TRANSITIONS[$this->status] ?? [];
        return in_array($newStatus, $allowed, true);
    }

    public static function generateRequestNumber(): string
    {
        $date = date('Ymd');
        $count = self::whereDate('created_at', today())->count() + 1;
        return sprintf('AF-%s-%04d', $date, $count);
    }

    // Relationships
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function addressRecord(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ServiceRequestImage::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(ServiceStatusHistory::class)->orderBy('created_at', 'asc');
    }

    public function quotation(): HasOne
    {
        return $this->hasOne(Quotation::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
