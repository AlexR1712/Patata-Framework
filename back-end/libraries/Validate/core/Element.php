<?php
namespace Validate;
require_once('/../user/Rule.php');
require_once('/../user/Message.php');
require_once('/../user/Error.php');
require_once('Helper.php');
class Element
{
	private $name;
	private $value;
	private $valid = true;
	private $messages = array();
	
	public function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}
	
	public function addRule($type, $arguments = array())
	{
		array_unshift($arguments, $this->value);
		if(Helper::existsRule($type))
		{
			$result = call_user_func_array(array(__NAMESPACE__ . '\Rule', $type), $arguments);
			if(!$result) { $this->valid = false; array_push($this->messages, Message::get($type)); }
		}
		else { Error::show(Message::noRule($type)); }
		
		return $this;
	}
	
	public function getName() { return $this->name; }
	public function getMessages() { return $this->messages; }
	public function isValid() { return $this->valid; }
}