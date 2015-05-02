<?php
require_once(MODEL . 'PageModel.php');
require_once(VIEW . 'PageView.php');

class PageController
{
	private $model;
	private $view;
	
	public function __construct()
	{
		$this->model = new PageModel();
		$this->view = new PageView();
	}
	
	public function index()
	{
		$message = $this->model->getMessage();
		$data = array('message' => $message);
		$this->view->index($data);
	}
	
	public function showError($error)
	{
		$data = array('error' => $error);
		$render = new Render($data, false);
		$render->addTemplate(HTML . 'page/error.html');
		$render->addStyle(CSS . 'page/error.css');
		echo $render;
	}
	
	public function s404()
	{
		$data = array();
		$render = new Render($data, false);
		$render->addTemplate(HTML . 'page/404.html');
		$render->addStyle(CSS . 'page/404.css');
		echo $render;
	}
}