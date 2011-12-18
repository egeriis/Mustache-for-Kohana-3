<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mustache extends ORM
{
	public function normalize()
	{
		return $this->_object;
	}
}