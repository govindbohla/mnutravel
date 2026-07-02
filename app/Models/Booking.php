<?php

namespace App\Models;

use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes, LogsActivityDefaults;

    protected $fillable = [
        'booking_no',
        'trip_type',
        'pickup_location',
        'drop_location',
        'journey_date',
        'journey_time',
        'return_date',
        'vehicle_id',
        'customer_id',
        'customer_name',
        'phone',
        'email',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'journey_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
