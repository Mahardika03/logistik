<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageType extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_type_code';

    protected $fillable = [
        'message_type_description'
    ];

    public function message()
    {
        return $this->hasMany(Message::class, 'message_type_code', 'message_type_code');
    }
}
