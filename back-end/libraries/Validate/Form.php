<?php
namespace Validate;
require_once('core/Element.php');
class Form
{
	private $elements = array();
	private $valid = true;
	private $messages = array();
	
	public function addValue($name, $value)
	{
		$element = new Element($name, $value);
		array_push($this->elements, $element);
		return $element;
	}
	public function addGet($name, $value) { return $this->addValue($name, $_GET[$value]); }
	public function addPost($name, $value) { return $this->addValue($name, $_POST[$value]); }
	
	private function validate()
	{
		foreach($this->elements as $element)
		{
			if(!$element->isValid())
			{
				$this->valid = false;
				$name = $element->getName();
				$messages = $element->getMessages();
				$this->messages[$name] = $messages;
			}
		}
	}
	
	public function getMessages() { return $this->messages; }
	public function isValid() { $this->validate(); return $this->valid; }
}