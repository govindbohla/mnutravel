<?php

namespace App\Models;

use App\Traits\HasSeo;
use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourPackage extends Model
{
    use HasFactory, SoftDeletes, LogsActivityDefaults, HasSeo;

    protected $fillable = [
        'name',
        'slug',
        'destination',
        'duration',
        'price',
        'featured_image',
        'description',
        'inclusions',
        'exclusions',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(TourPackageImage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
