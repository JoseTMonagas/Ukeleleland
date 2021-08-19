<?php

namespace Tests\Unit;

use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateAMessage()
    {
        $user = factory(User::class)->create();
        $room = factory(Conversation::class)->create();

        $response = $this->actingAs($user)
                         ->post('messages/store', [
                             'body' => 'Hi, there!',
                             'room_id' => $room->id
                         ]);

        $this->assertDatabaseHas('messages', [
            'body' => 'Hi, there!',
            'room_id' => $room->id
        ]);

        $response->assertStatus(201);
    }

    public function testCanBroadcastMessage()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $room = factory(Conversation::class)->create();

        $response = $this->actingAs($user)
                         ->post('messages/store', [
                             'body' => 'Hi, there',
                             'room_id' => $room->id
                         ]);

        $message = Message::first();

        Event::assertDispatched(MessageSent::class, function ($e) use($message) {
            return $e->message->id === $message->id;
        });
    }
}
