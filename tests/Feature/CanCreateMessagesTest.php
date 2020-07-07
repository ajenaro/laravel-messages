<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanCreateMessagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_create_messages()
    {

        $user = factory(User::class)->create();
        $recipient1 = factory(User::class)->create();
        $recipient2 = factory(User::class)->create();

        $data = [
            'recipients' => [$recipient1->id, $recipient2->id],
            'subject' => 'Hola',
            'body' => 'Cuerpo del mensaje'
        ];

        $this->actingAs($user);

        $response = $this->post(route('admin.messages.store'), $data);

        $this->assertDatabaseHas('messages', [
            'sender_id' => $user->id,
            'subject' => 'Hola',
            'body' => 'Cuerpo del mensaje',
        ]);

        $this->assertDatabaseHas('message_recipients', [
            'recipient_id' => $recipient1->id,
        ]);

        $this->assertDatabaseHas('message_recipients', [
            'recipient_id' => $recipient2->id,
        ]);

        $response->assertRedirect(route('admin.messages.index'));
    }
}
