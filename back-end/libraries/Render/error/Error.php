<?php
namespace Render;
use Caller\Caller;
abstract class Error
{
	public static function show($message)
	{
		if(IS_PRODUCTION) { Caller::run(ERROR_CONTROLLER, ERROR_METHOD, array($message)); }
	}
}