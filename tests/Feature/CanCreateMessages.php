<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanCreateMessages extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_user_can_create_messages()
    {

        $user = factory(User::class)->create();
        $data = [
            'sender_id' => $user->id,
            'subject' => 'Hola',
            'body' => 'Cuerpo del mensaje'
        ];

        $this->actingAs($user);

        $response = $this->post(route('admin.messages.store'), $data);

        //$response->assertRedirect('admin.messages.index');

        $this->assertDatabaseHas('messages', [
            'sender_id' => $user->id,
            'subject' => 'Hola',
            'body' => 'Cuerpo del mensaje',
        ]);
    }
}
