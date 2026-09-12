<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_request_id',
        'technician_id',
        'subtotal',
        'service_fee',
        'discount',
        'total',
        'notes',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function serviceRequest(): BelongsTo
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function recalculateTotal(): void
    {
        $this->subtotal = $this->items()->sum('subtotal');
        $this->total = max(0, ($this->subtotal + $this->service_fee) - $this->discount);
        $this->save();
    }
}
