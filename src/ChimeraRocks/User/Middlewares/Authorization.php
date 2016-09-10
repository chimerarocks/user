<?php 

namespace ChimeraRocks\User\Middlewares;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;

class Authorization 
{
	private $gate;

	public function __construct(Gate $gate)
	{
		$this->gate = $gate;
	}



	public function handle($request, Closure $next, $ability)
	{
		$this->gate->authorize($ability);
		return $next($request);
	}

	/*
		on kernel.php

		$routeMiddleware = [
			...
			'authorization' => ChimeraRocks\User\Middlewares\Authorization
		]
	 */
}