<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $primaryKey = 'location_id';
    protected $fillable = [
        'address_id', 'location_type_code', 'location_detail'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }

    public function locationType()
    {
        return $this->belongsTo(LocationType::class, 'location_type_code', 'location_type_code');
    }

    public function shipment()
    {
        return $this
                ->hasMany(Shipment::class, 'start_location_id', 'location_id')
                ->hasMany(Shipment::class, 'end_location_id', 'location_id');
    }
}
