<?php

namespace App\Models;

use App\Traits\HasSeo;
use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes, LogsActivityDefaults, HasSeo;

    protected $fillable = [
        'vehicle_category_id',
        'name',
        'slug',
        'image',
        'passenger_capacity',
        'luggage_capacity',
        'is_ac',
        'description',
        'price',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_ac' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
