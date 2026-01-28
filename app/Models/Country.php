<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ShippingRateCard;
use App\Models\ShippingZone;

class Country extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function shippingZonesAsOrigin(): HasMany
    {
        return $this->hasMany(ShippingZone::class, 'origin_country_id');
    }

    public function shippingRateCardsAsOrigin(): HasMany
    {
        return $this->hasMany(ShippingRateCard::class, 'origin_country_id');
    }
}

