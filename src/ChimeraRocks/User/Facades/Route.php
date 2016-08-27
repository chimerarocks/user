<?php

namespace ChimeraRocks\User\Facades;

use Illuminate\Support\Facades\Facade;

class Route extends Facade
{


	/**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
	protected static function getFacadeAccessor()
	{
		return 'chimerarocks_user_route';
	}
}