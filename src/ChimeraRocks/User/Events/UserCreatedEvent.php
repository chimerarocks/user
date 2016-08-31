<?php

namespace ChimeraRocks\User\Events;

class UserCreatedEvent
{
	private $user;
	private $password;

	public function __construct($user, $password)
	{
		$this->user = $user;
		$this->password = $password;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}
}