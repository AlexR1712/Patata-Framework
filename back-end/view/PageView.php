<?php
require_once(LIBRARIES . 'Render/Render.php');
use Render\Render;

class PageView
{
	public function index($data = array())
	{
		$render = new Render($data, true);
		$render->addTemplate(HTML . 'page/index.html');
		$render->addStyle(CSS . 'page/styles.css');
		$render->addScript(JS . 'page/scripts.js');
		echo $render;
	}
}