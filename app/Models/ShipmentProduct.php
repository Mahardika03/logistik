<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'shipment_product_id';
    protected $fillable = [
        'shipment_id', 'product_id', 'quantity', 'other_details'
    ];
}
