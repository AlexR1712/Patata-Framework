<?php
error_reporting(E_ALL); // Borrar luego

require_once('config.php');
require_once('config_core.php');
require_once('core/UriDecoder/URIDecoder.php');
require_once('core/Caller/Caller.php');

use UriDecoder\URIDecoder;
use Caller\Caller;

$URIDecoder = new URIDecoder();
$class = $URIDecoder->getClass();
$method = $URIDecoder->getMethod();
$arguments = $URIDecoder->getArguments();

Caller::run($class, $method, $arguments);