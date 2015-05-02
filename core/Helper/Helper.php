<?php
namespace Helper;
class Helper
{
	/*
		Example: http://localhost/my_project
		Return: my_project
	*/
	public static function getFolder()
	{
		$self = $_SERVER['PHP_SELF'];
		return dirname($self);
	}

	/*
		Example: http://localhost/my_project
		Return: http://localhost/my_project/
	*/
	public static function getRoot()
	{
		$protocol = 'http';
		$server = $_SERVER['SERVER_NAME'];
		return $protocol . '://' . $server . self::getFolder() . '/';
	}
}