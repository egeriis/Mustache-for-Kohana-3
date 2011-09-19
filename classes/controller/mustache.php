<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Mustache base controller.
 *
 * @package    Mustache
 * @category   Controllers
 * @author     Ronni Egeriis Persson
 * @copyright  (c) 2011 Ronni Egeriis Persson
 * @license    MIT
 */
class Controller_Mustache extends Controller_Template
{
	/**
	 * @var  MustacheView  Holds the current view
	 */
	public $view;
	
	/**
	 * Check if the HTTP request is made through AJAX. If that's the case, it will 
	 * respond with the view's data as JSON instead of the view/template markup.
	 *
	 * See: http://kohanaframework.org/3.2/guide/api/Controller_Template#after
	 *
	 * @return  void
	 */
	public function after()
	{
		if ($this->is_ajax()) $this->expose_view();
		parent::after();
	}
	
	/**
	 * Method used to set JSON Content-Type header and respond with JSON data.
	 * This method calls exit, thus no other methods are called after this.
	 *
	 * @return void
	 */
	protected function expose_view()
	{
		header('Content-Type: application/json', true);
		exit(json_encode($this->view->expose_data()));
	}
	
	/**
	 * Checks if current HTTP request is made through AJAX.
	 *
	 * @return boolean
	 */
	protected function is_ajax()
	{
		if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) return false;
		return ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
	}
}