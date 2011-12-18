<?php defined('SYSPATH') or die('No direct script access.');

class MustacheView
{
	protected static $templates;
	
	protected $values;
	public $name;

	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function __get($key)
	{
		if (!isset($this->values[$key])) return false;
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
		return $m->render(self::load_template($this->name), $this, self::$templates);
	}
	
	public function expose_data()
	{
		return $this->values;
	}
	
	public function markup()
	{
	}
	
	public static function factory($name)
	{
		return new self($name);
	}
	
	/**
	 * Load a template and cache this.
	 * @param string name Name of template
	 * @return string Returns markup
	 * @throws Exception If no template was find with the given name
	 */
	protected static function load_template($name)
	{
		if (isset(self::$templates[$name])) return self::$templates[$name];
		
		$markup = @file_get_contents(APPPATH . 'views/' . $name . '.ms');
		if (empty($markup)) throw new Exception('No template found with name given: ' . $name);
		
		self::save_template($name, $markup);
		self::find_partials($markup);
		
		return $markup;
	}
	
	/** 
	 * Cache the template (only cached within same page load)
	 * @param string name Name of template
	 * @param string markup Mustache markup
	 * @return void
	 */
	protected static function save_template($name, $markup)
	{
		if (!self::$templates) self::$templates = array();
		self::$templates[$name] = $markup;
	}
	
	/**
	 * Find partials in markup and auto-load
	 * @param string markup The markup to be parsed for partials
	 * @return void
	 */
	protected static function find_partials($markup)
	{
		if (preg_match_all('/{{\>([\s\S]*?)}}/', $markup, $matches, PREG_SET_ORDER) == false) return $markup;
	
		foreach ($matches as $match)
		{
			self::load_template($match[1]);
		}
	}
}