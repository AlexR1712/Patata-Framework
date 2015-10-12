<?php
namespace Caller;
abstract class Error
{
	public static function show($message)
	{
		if(IS_PRODUCTION) { Caller::run(ERROR_CONTROLLER, ERROR_METHOD, array($message)); }
		else { Caller::run(S404_CONTROLLER, S404_METHOD); }
	}
}