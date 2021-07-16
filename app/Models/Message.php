<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $primaryKey = 'message_id';
    protected $fillable = [
        'message_type_code', 'shipment_id'
    ];

    public function messageType()
    {
        return $this->belongsTo(MessageType::class, 'message_type_code', 'message_type_code');
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'shipment_id');
    }
}
