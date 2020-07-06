<?php

namespace Tests\Feature\Models;

use App\Message;
use App\MessageRecipient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageRecipientTest extends TestCase
{
    /** @test */
    function a_recipient_belongs_to_a_message()
    {
        $recipient = factory(MessageRecipient::class)->create();

        $this->assertInstanceOf(Message::class, $recipient->message);
    }
}
