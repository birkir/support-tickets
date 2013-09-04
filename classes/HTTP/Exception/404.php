<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Ticket Controller
 *
 * @package    Support Tickets
 * @category   Exceptions
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class HTTP_Exception_404 extends Kohana_HTTP_Exception_404 {

	public function get_response()
	{
		if (Kohana::$environment === Kohana::PRODUCTION)
		{
			$this->template = View::factory('Template')
			->set('auth', Auth::instance())
			->set('title', 'Support Ticket');

			$this->template->view = Request::factory('Template/404')->execute()->body();

			$response = Response::factory();
			$response->body($this->template);

			return $response;
		}
		else
		{
			return parent::get_response();
		}
	}

} // End Exception 404