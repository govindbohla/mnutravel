<?php

namespace App\Models;

use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleCategory extends Model
{
    use HasFactory, SoftDeletes, LogsActivityDefaults;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
