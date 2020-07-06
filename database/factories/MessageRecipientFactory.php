<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\MessageRecipient;
use App\User;
use Faker\Generator as Faker;

$factory->define(MessageRecipient::class, function (Faker $faker) {
    return [
        'message_id' => function() {
            return factory(Message::class)->create();
        },
        'recipient_id' => function() {
            return factory(User::class)->create();
        },
    ];
});
