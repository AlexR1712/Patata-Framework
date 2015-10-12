<?php
namespace DB;
abstract class Message
{
	public static function error() { return 'Ocurrió un error, inténtelo mas tarde'; }
}