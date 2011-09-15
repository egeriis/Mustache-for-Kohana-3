# Mustache for Kohana 3
#### version 0.1

`Mustache for Kohana 3` is a simple wrapper to easily implement Mustache within your Kohana 3 project. 

It is dependent on the Mustache class by Justin Hileman <http://defunkt.github.com/mustache>. This class is also included in this module, as it has been enhanced a bit.

### How to use

1. Add `classes` to a folder of your choice in your `modules` directory
2. Load the module through `Kohana::modules` in your `application/bootstrap.php` file
3. Use `MustacheView::factory` or `new MustacheView` like you do with the default `View` class

That's it folks!

#### Brought to you by <http://egeriis.me>