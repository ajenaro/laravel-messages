<?php

namespace App;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function newmessages()
    {
        return Message::whereHas('recipients', function ($query) {
            $query->where('recipient_id', auth()->user()->id);
            $query->whereNull('read_at');
        })->latest()->get();
    }

    public function ownmessages()
    {
        return Message::whereHas('recipients', function ($query) {
            $query->where('recipient_id', $this->id);
            $query->whereNotNull('read_at');
        })->latest()->get();
    }

    public function gravatar()
    {
        return Gravatar::get($this->email);
    }
}
