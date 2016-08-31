<?php

namespace Test\User\Event;

use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Models\User;
use Mockery;
use Test\AbstactTestCase;

class UserCreatedEventTest extends AbstactTestCase
{
	protected $event;

	public function setUp()
	{
		parent::setUp();
		$userMock = Mockery::mock(User::class);
		$this->event = new UserCreatedEvent($userMock, '123456');
	}

	public function test_can_get_user()
	{
		$this->assertInstanceOf(User::class, $this->event->getUser());
	}

	public function test_can_set_user()
	{
		$userMock = Mockery::mock(User::class);
		$result = $this->event->setUser($userMock);
		$this->assertInstanceOf(UserCreatedEvent::class, $result);
		$this->assertInstanceOf(User::class, $this->event->getUser());
	}

	public function test_can_get_password()
	{
		$this->assertInstanceOf('123456', $this->event->getPassword());
	}

	public function test_can_set_password()
	{
		$result = $this->event->setPassword('654321');
		$this->assertInstanceOf(UserCreatedEvent::class, $result);
		$this->assertInstanceOf('654321', $this->event->getPassword());
	}

	public function test_constructor()
	{
		$this->assertInstanceOf(User::class, $this->event->getUser());
		$this->assertEquals('123456', $this->event->getPassword());
	}
}