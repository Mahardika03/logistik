<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    use HasFactory;

    protected $primaryKey = 'location_type_code';
    protected $fillable = ['location_type_description'];

    public function location()
    {
        return $this->hasMany(Location::class, 'location_type_code', 'location_type_code');
    }
}
