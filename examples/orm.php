<?php

/**
 * Example of how to resolve the problem with exposing values of ORM objects in Kohana.
 */

// 1. Extend ORM with a class that holds a normalize method. Extend your model classes to this.

class EnhancedORM extends ORM
{
	public function normalize()
	{
		return $this->_object;
	}
}

class Model_User extends EnhancedORM
{
}

// 2. Create a utility class to normalize an array of ORM models.

class Utils
{
	public static function normalize($result)
	{
		$a = array();
		foreach ($result->as_array() as $obj)
		{
			$a[] = $obj->normalize();
		}
		return $a;
	}
}

// 3. Wrap your ORM result with Utils::normalize(). 
//
// This will expose an array of the ORM models' internal data object.
//
// The ORM methods is no longer available, but your data is accessed
// through the same properties as before.

$this->view->users = Utils::normalize(ORM::factory('users')->find_all());