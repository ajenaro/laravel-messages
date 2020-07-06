<?php

namespace Tests\Feature\Models;

use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_has_many_messages()
    {
        $user = factory(User::class)->create();

        factory(Message::class)->create(['sender_id' => $user->id]);

        $this->assertInstanceOf(Message::class, $user->messages()->first());
    }
}
