<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipients()
    {
        return $this->hasMany(MessageRecipient::class);
    }
}
