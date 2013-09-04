<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Account Controller
 *
 * @package    Support Tickets
 * @category   Controller
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Controller_Account extends Controller_Template {

	/**
	 * Redirect to login page
	 *
	 * @uses   HTTP
	 * @return void
	 */
	public function action_Index()
	{
		HTTP::redirect('Account/Login');
	}

	/**
	 * Show login form and process controller
	 *
	 * @uses   HTTP
	 * @uses   Form
	 * @return void
	 */
	public function action_Login()
	{
		// already logged in
		if ($this->auth->logged_in())
			return HTTP::redirect('Ticket');

		// setup login view
		$this->view = View::factory('Account/Login')
		->set('auth', $this->auth)
		->bind('form', $form);

		// create model
		$item = ORM::factory('User');

		// create form
		$form = Form::factory($item);

		// match http post method
		if ($this->request->method() === HTTP_Request::POST)
		{
			// get post array
			$post = $this->request->post();
	
			// try authentication
			if ( ! $this->auth->login($post['email'], $post['password'], isset($post['remember'])))
			{
				// manually create arrors
				if ( ! ORM::factory('User', ['email' => $post['email']])->loaded())
				{
					$form->attach(['email' => 'no account associated with this email']);
				}
				else
				{
					$form->attach(['password' => 'your password is incorrect']);
				}
			}
		}
	}

	/**
	 * Show register form and process controller
	 *
	 * @uses   Form
	 * @return void
	 */
	public function action_Register()
	{
		// setup fieldset view
		$this->view = View::factory('Account/Register')
		->bind('form', $form);

		// create user model
		$item = ORM::factory('User');

		// factory an form
		$form = Form::factory($item);

		// process post http requests
		if ($this->request->method() === HTTP_Request::POST)
		{
			try
			{
				// create user using Auth method
				$item->create_user($this->request->post(), ['email', 'password']);

				// add logged in role
				$item->add('roles', ORM::factory('Role', ['name' => 'login']));
			}
			catch (ORM_Validation_Exception $e)
			{
				$form->attach($e);
			}
		}
	}

	/**
	 * Logout controller
	 * 
	 * @uses   HTTP
	 * @return void
	 */
	public function action_Logout()
	{
		// log user out
		$this->auth->logout();

		// redirect to login
		HTTP::redirect('Account/Login');
	}

} // End Account