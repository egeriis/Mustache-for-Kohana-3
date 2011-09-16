# Mustache for Kohana 3
#### version 0.1

`Mustache for Kohana 3` is a simple wrapper to easily implement Mustache within your Kohana 3 project. 

It is dependent on the Mustache class by Justin Hileman <http://defunkt.github.com/mustache>. This class is included in this module, but remember to check for updates.

##### Feature requests are very welcome!

### How to use

1. Add `classes` to a folder of your choice in your `modules` directory
2. Load the module through `Kohana::modules` in your `application/bootstrap.php` file
3. Use `MustacheView::factory` or `new MustacheView` like you do with the default `View` class

That's it folks!

### Example

	$view = MustacheView::factory('edit_user');
	$view->username = 'Hello Kitty';
	echo $view;

#### Brought to you by <http://egeriis.me>