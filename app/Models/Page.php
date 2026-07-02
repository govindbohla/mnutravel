<?php

namespace App\Models;

use App\Traits\HasSeo;
use App\Traits\LogsActivityDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes, LogsActivityDefaults, HasSeo;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
