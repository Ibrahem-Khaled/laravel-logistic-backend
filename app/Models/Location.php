<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function shipment()
    {
        return $this->belongsToMany(Shipment::class, 'shipment_trackings', 'location_id', 'shipment_id');
    }
}
