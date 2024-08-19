<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function container()
    {
        return $this->belongsToMany(Container::class, 'shipment_trackings', 'location_id', 'container_id')
            ->withPivot('expected_arrival_date');
    }
}
