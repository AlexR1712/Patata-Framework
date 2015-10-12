<?php
namespace Validate;
abstract class Message
{
	private static $messages = array
	(
		'default' 		=> 'No es v&aacute;lido', 
		'isEmail' 		=> 'Debe de ser un email', 
		'isFloat' 		=> 'Debe de ser un valor decimal', 
		'isInt' 		=> 'Debe de ser un entero', 
		'isBetween' 	=> 'Esta fuera de rango', 
		'isUrl' 		=> 'Debe de ser una url', 
		'isDate' 		=> 'Debe de ser una fecha', 
		'isFilled' 		=> 'No debe de estar vácio', 
		'isPositive' 	=> 'Debe de ser un valor mayor a cero', 
		'isW' 			=> 'Solo esta permitido cáracteres alfanuméricos y sub-gui&oacute;n', 
		'isD' 			=> 'Solo esta permitido cáracteres numéricos', 
		'isWord' 		=> 'Solo esta permitido letras', 
		'isWord' 		=> 'Solo esta permitido letras y espacios', 
		'isAN' 			=> 'Solo esta permitido cáracteres alfanuméricos', 
		'isANs' 		=> 'Solo esta permitido cáracteres alfanuméricos y espacios', 
		'isName' 		=> 'Solo esta permitido letras', 
		'isNames' 		=> 'Solo esta permitido letras y espacios', 
		'existsMinimum'	=> 'Elementos insuficientes', 
	);

	public static function noRule($rule) { return 'No existe la regla: ' . $rule . '.'; }
	
	/* Danger */
	public static function get($type)
	{
		if(isset(self::$messages[$type])) { return self::$messages[$type]; }
		else { return self::$messages['default']; }
	}
}