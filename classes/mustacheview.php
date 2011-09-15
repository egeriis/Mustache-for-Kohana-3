<?php defined('SYSPATH') or die('No direct script access.');

class MustacheView
{
	protected $values;
	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function __get($name)
	{
		if (empty($this->values[$name])) return false;
		return $this->values[$name];
	}
	
	public function __set($name, $value)
	{
		$this->values[$name] = $value;
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