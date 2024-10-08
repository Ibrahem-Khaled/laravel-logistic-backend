<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function location()
    {
        return $this->belongsToMany(Location::class, 'shipment_trackings', 'container_id', 'location_id')
            ->withPivot('expected_arrival_date');
    }
}
