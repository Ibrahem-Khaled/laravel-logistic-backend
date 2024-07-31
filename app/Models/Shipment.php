<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function location()
    {
        return $this->belongsToMany(Location::class, 'shipment_trackings', 'shipment_id', 'location_id');
    }
}
