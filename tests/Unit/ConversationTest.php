<?php

namespace Tests\Unit;

use App\Conversation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ConversationTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanJoinRoom()
    {
        $user = factory(User::class)->create();

        $room = factory(Conversation::class)->create();
        $room->join($user);

        $found = $room->users->where('id', $user->id)->first();

        $this->assertInstanceOf(User::class, $found);
        $this->assertEquals($user->id, $found->id);  
    }
}
