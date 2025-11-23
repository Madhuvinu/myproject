<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsImage extends Model
{
    protected $fillable = [
        'about_us_id',
        'image_path',
        'order',
    ];

    public function aboutUs()
    {
        return $this->belongsTo(AboutUs::class);
    }
}
