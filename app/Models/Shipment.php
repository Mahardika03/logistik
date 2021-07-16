<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $primaryKey = 'shipment_id';
    protected $fillable = [
        'start_location_id', 'end_location_id', 'start_date_expected', 'end_date_expected', 'other_details',
        'start_date_actual', 'end_date_actual'
    ];

    public function locationOne()
    {
        return $this->belongsTo(Location::class, 'start_location_id', 'location_id');
    }

    public function locationTwo()
    {
        return $this->belongsTo(Location::class, 'end_location_id', 'location_id');
    }

    public function message()
    {
        return $this->hasOne(Message::class, 'shipment_id', 'shipment_id');
    }
}
