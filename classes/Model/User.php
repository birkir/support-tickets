<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * User Model
 *
 * @package    Support Tickets
 * @category   Model
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Model_User extends Model_Auth_User {

	public function rules()
	{
		$rules = parent::rules();

		$rules['username'] = [];

		return $rules;
	}

	public function unique_key($value)
	{
		return 'email';
	}

} // End User