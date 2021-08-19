<?php

namespace Tests\Unit;

use App\Conversation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    private $conversation;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->conversation = factory(Conversation::class)->create();
    }
    /**
     * Prueba si el Usuario es capaz de contactar
     *
     * @return bool
     */
    public function testCanAddConversation()
    {
        $this->user->addConversation($this->room);

        $found = $this->user->conversations->where('id', $this->conversation->id)->first();

        $this->assertInstanceOf('\App\Conversation', $found);
        $this->assertEquals($this->conversation->id, $found->id);
    }

    public function testUserHasJoinedRoom()
    {
        $this->conversation->join($this->user);

        $this->assertTrue($this->user->hasJoined($this->conversation->id));
    }   
}
