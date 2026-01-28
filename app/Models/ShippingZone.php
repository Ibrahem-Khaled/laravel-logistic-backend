<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ShippingRate;
use App\Models\ShippingZoneCountry;

class ShippingZone extends Model
{
    protected $guarded = ['id'];

    public function originCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'origin_country_id');
    }

    public function countryMappings(): HasMany
    {
        return $this->hasMany(ShippingZoneCountry::class, 'shipping_zone_id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany(ShippingRate::class, 'shipping_zone_id');
    }
}

