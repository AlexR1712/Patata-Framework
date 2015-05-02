<?php
namespace Render;
abstract class PDictionary
{
	public static function getSuperData()
	{
		return array
		(
			'ROOT' => \ROOT, 
			'FE' => \FE
		);
	}
}