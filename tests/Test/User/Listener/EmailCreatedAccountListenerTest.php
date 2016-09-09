<?php

namespace Test\User\Listener;

use ChimeraRocks\User\Events\UserCreatedEvent;
use ChimeraRocks\User\Listeners\EmailCreatedAccountListener;
use ChimeraRocks\User\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Event;
use Mockery;
use Test\AbstractTestCase;

class EmailCreatedAccountListenerTest extends AbstractTestCase
{
	protected $event;

	public function setUp()
	{
		parent::setUp();
		$this->migrate();
	}
	
	public function test_check_listener_registered_event()
	{
		$array = Event::getListeners(UserCreatedEvent::class);
		$this->assertCount(1, $array);
	}

	public function test_can_trigger_handle()
	{
		$userMock = Mockery::mock(User::class);
		$userMock->shouldReceive('getAttribute')->with('name')->andReturn('test');
		$userMock->shouldReceive('getAttribute')->with('email')->andReturn('test@user.com');
		$userMock->shouldReceive('getAttribute')->with('password')->andReturn('123456');

		$event = new UserCreatedEvent($userMock, $userMock->password);

		$mockMailer = Mockery::mock(Mailer::class);
		$mockMailer->shouldReceive('send')
			->with('email.registration', [
				'username' => $userMock->email,
				'password' => $userMock->password,
			], Mockery::on(function(\Closure $closure) use ($userMock) {
				$mockMessage = Mockery::mock(Message::class);
				$mockMessage->shouldReceive('to')
					->with($userMock->email, $userMock->name)
					->andReturn($mockMessage);
				$mockMessage->shouldReceive('subject')
					->with("{$userMock->name}, sua conta foi criada!");
				$closure($mockMessage);
				return true;
			}))
			->andReturn(1);
			
		$listener = new EmailCreatedAccountListener($mockMailer);
		$result = $listener->handle($event);
		$this->assertEquals(1, $result);
	}

}