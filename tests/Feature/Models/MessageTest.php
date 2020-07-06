<?php

namespace Tests\Feature\Models;


use App\Message;
use App\MessageRecipient;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_message_belongs_to_a_user()
    {
        $message = factory(Message::class)->create();

        $this->assertInstanceOf(User::class, $message->user);
    }

    /** @test */
    function a_message_has_many_recipients()
    {
        $message = factory(Message::class)->create();

        factory(MessageRecipient::class)->create(['message_id' => $message->id]);

        $this->assertInstanceOf(MessageRecipient::class, $message->recipients()->first());
    }
}
