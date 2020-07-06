<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'sender_id' => function() {
            return factory(User::class)->create();
        },
        'subject' => $faker->text,
        'body' => $faker->paragraph,
    ];
});
