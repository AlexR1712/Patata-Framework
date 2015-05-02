<?php
namespace URIDecoder;

require_once('config/config.php');
require_once('config/Helper.php');

class URIDecoder
{
	public function __construct()
	{
		$this->class = \CLASS_DEFAULT;
		$this->method = \METHOD_DEFAULT;
		$this->arguments = array();
		
		// Obtenemos la URI limpiando los URI_SEPARATOR y removiendo el directorio contenedor
		$this->uri = trim(substr($_SERVER['REQUEST_URI'], Helper::getFolderLength()), URI_SEPARATOR);

		if($this->uri) // Si existe una URI
		{
			$this->arguments = explode(URI_SEPARATOR, $this->uri); // Dividimos la URI en partes segun el URI_SEPARATOR
			if($this->arguments)
			{
				$this->class = array_shift($this->arguments);
				if($this->arguments) { $this->method = array_shift($this->arguments); }
			}
		}
	}
	
	public function getClass() { return $this->class; }
	public function getMethod() { return $this->method; }
	public function getArguments() { return $this->arguments; }
}