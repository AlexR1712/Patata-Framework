<?php
require_once(LIBRARIES . 'Render/Render.php');
use Render\Render;

class PageView
{
    private $html;
    private $css;
    private $js;
    
	public function index($data = array())
	{
		$render = new Render($data, true);
		$render->addTemplate(HTML . 'page/index.html');
		$render->addStyle(CSS . 'page/styles.css');
		$render->addScript(JS . 'page/scripts.js');
		echo $render;
	}
    
    public function showError($data = array())
	{
		$render = new Render($data, false);
		$render->addTemplate(HTML . 'page/error.html');
		$render->addStyle(CSS . 'page/error.css');
		echo $render;
	}
    
    public function s404($data = array())
	{
		$render = new Render($data, false);
		$render->addTemplate(HTML . 'page/404.html');
		$render->addStyle(CSS . 'page/404.css');
		echo $render;
	}
}