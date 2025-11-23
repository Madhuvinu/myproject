<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $fillable = [
        'title',
        'content',
        'mission',
        'vision',
        'values',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(AboutUsImage::class)->orderBy('order');
    }
}
