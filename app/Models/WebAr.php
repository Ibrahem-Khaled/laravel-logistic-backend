<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebAr extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_title',
        'site_description',
        'site_image',
        'keywords',
        'hero_title',
        'hero_description',
        'hero_image',
        'about_title',
        'about_description',
        'about_image',
        'about_features',
        'location_title',
        'location_description',
        'location_image',
    ];
}
