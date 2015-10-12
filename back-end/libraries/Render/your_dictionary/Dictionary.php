<?php
namespace Render;
require_once('/../core/PDictionary.php');
abstract class Dictionary extends PDictionary
{
	public static function get()
	{
		return array
		(
			'title' => \TITLE, 
			'description' => \DESCRIPTION
		);
	}
}