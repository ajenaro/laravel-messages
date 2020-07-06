<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageRecipient extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
