<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'address_id';
    protected $fillable = ['address_detail'];

    public function Location()
    {
        return $this->hasMany(Location::class, 'address_id', 'address_id');
    }

}
