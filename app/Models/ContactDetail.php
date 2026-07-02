<?php

namespace App\Models;

use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use LogsActivityDefaults;

    protected $fillable = [
        'address',
        'phone',
        'alt_phone',
        'email',
        'map_iframe',
        'business_hours',
    ];

    protected function casts(): array
    {
        return [
            'business_hours' => 'array',
        ];
    }
}
