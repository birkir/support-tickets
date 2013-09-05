<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Template Controller
 *
 * @package    Support Tickets
 * @category   Controller
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Controller_Template extends Controller {

	/**
	 * @var string Template filename
	 */
	public $template = 'Template';

	/**
	 * @var View variable
	 */
	public $view;

	/**
	 * Before controller execution
	 *
	 * @uses   Auth
	 * @uses   View
	 * @return void
	 */
	public function before()
	{
		// set auth
		$this->auth = Auth::instance();

		// set user
		$this->user = $this->auth->get_user();

		// initialize View template
		$this->template = View::factory($this->template)
		->set('auth', $this->auth)
		->set('title', 'Support Tickets')
		->set('controller', Request::current()->controller());
	}

	/**
	 * Not found function
	 */
	public function not_found($message = '404 Not found')
	{
		$this->view = View::factory('Not_Found')
		->set('message', $message);
	}

	/**
	 * Not found action
	 */
	public function action_404()
	{
		$this->not_found();
	}

	/**
	 * After controller execution
	 *
	 * @return void
	 */
	public function after()
	{
		// check if template is View
		if ($this->template instanceof View)
		{
			// add main view to template
			$this->template->view = $this->view;
		}

		// attach template view to body response
		$this->response->body($this->request == Request::initial() ? $this->template : $this->view);
	}

} // End Template