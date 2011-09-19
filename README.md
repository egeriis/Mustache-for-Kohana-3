# Mustache for Kohana 3
### version 0.1.5

`Mustache for Kohana 3` is a simple wrapper to easily implement Mustache within your Kohana 3 project. 

It is dependent on the Mustache class by Justin Hileman <http://defunkt.github.com/mustache>. This class is included in this module, but remember to check for updates.

#### Feature requests are very welcome!

## How to use

1. Add `classes` to a folder of your choice in your `modules` directory
2. Load the module through `Kohana::modules` in your `application/bootstrap.php` file
3. Use `MustacheView::factory` or `new MustacheView` like you do with the default `View` class

That's it folks!

## Examples

### Basic

This is basic usage example. The MustacheView class is intended to work exactly like you use the regular Kohana 3 View class.

	$view = MustacheView::factory('edit_user');
	$view->username = 'Hello Kitty';
	echo $view;

### Expose view data through JSON

The `expose_data` method is practical for users who want to share both views and their data between Kohana and JavaScript front-end.

	$view = MustacheView::factory('community/users');
	$view->users = array(new User(1), new User(2));
	
	header("Content-Type: application/json" true);
	exit(json_encode($view->expose_data()));


#### Brought to you by <http://egeriis.me>