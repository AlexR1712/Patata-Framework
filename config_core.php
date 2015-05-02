<?php
require_once('core/Helper/Helper.php');
use Helper\Helper;

# Constantes
define('CONTROLLER_SUFFIX', 'Controller');
define('ERROR_CONTROLLER', 'Page');
define('ERROR_METHOD', 'showError');
define('S404_CONTROLLER', 'Page');
define('S404_METHOD', 'S404');

# Routes
define('FOLDER', Helper::getFolder());
define('ROOT', Helper::getRoot());
define('BACK_END', 'back-end/');
define('MODEL', BACK_END . 'model/');
define('VIEW', BACK_END . 'view/');
define('CONTROLLER', BACK_END . 'controller/');
define('HELPER', BACK_END . 'helper/');
define('LIBRARIES', BACK_END . 'libraries/');
define('FE', ROOT . 'front-end/');
define('FRONT_END', 'front-end/');
define('HTML', FRONT_END . 'html/');
define('CSS', FE . 'css/');
define('JS', FE . 'js/');
define('VENDOR', FE . 'vendor/');