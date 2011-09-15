<?php defined('SYSPATH') or die('No direct script access.');

class MustacheView
{
	protected $values;
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function __get($key)
	{
		if (empty($this->values[$key])) return false;
		return $this->values[$key];
	}
	
	public function __set($key, $value)
	{
		if (is_object($value) && method_exists($value, '__toString')) 
		{
			$value = $value->__toString();
		}
		$this->values[$key] = $value;
	}
	
	public function __toString()
	{
		return $this->render();
	}
	
	public function __isset($key)
	{
		return (isset($this->values[$key]));
	}
	
	public function render()
	{
		$m = new Mustache;
		return $m->render($this->markup(), $this);
	}
	
	protected function markup()
	{
		return file_get_contents(APPPATH . 'views/' . $this->name . '.ms');
	}
	
	public static function factory($name)
	{
		return new self($name);
	}
}