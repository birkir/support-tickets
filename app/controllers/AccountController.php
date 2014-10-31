<?php

class AccountController extends BaseController {

	public function showLogin()
	{
		if (Auth::check())
			return Redirect::intended('tickets');

		return View::make('account/login');
	}

	public function doLogin()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('account/login')
				->withErrors($validator)
				->withInput(Input::except('password'));
		}
		else
		{
			$userdata = array(
				'email' 	=> Input::get('email'),
				'password' 	=> Input::get('password')
			);

			if (Auth::attempt($userdata, Input::get('remember') === 'true'))
			{
				return Redirect::intended('tickets');
			}
			else
			{
				return Redirect::to('account/login')
				->withErrors(['Wrong E-Mail address or password']);
			}
		}
	}

	public function showRegister()
	{
		return View::make('account/register');
	}

	public function showLogout()
	{
		if (Auth::check())
		{
			Auth::logout();
		}

		return Redirect::to('account/login');
	}
}

