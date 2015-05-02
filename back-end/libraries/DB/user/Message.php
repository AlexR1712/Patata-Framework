<?php
namespace DB;
abstract class Message
{
	public static function error() { return 'Ocurrio un error, intentelo mas tarde'; }
}