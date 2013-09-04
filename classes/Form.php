<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Form extended helper class.
 *
 * @package    Support Tickets
 * @category   Helpers
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Form extends Kohana_Form {

	public $message_success = '<strong>Thank you!</strong><br>The form has been submitted.';

	public $message_errors = '<strong>Validation Error</strong><br>We found some errors while processing the form, please correct them below.';

	protected $errors = [];

	public static function factory($model = NULL, $extra_validation = NULL)
	{
		return new Form($model, $extra_validation);
	}

	public function __construct($model)
	{
		$this->model = $model;
		$this->request = Request::current();
		$this->post = $this->request->post();

		return $this;
	}

	public function valid()
	{
		return count($this->errors) === 0;
	}

	public function attach($errors)
	{
		$original = $this->errors;

		if ($errors instanceof ORM_Validation_Exception)
		{
			$errors = $errors->errors('models/'.$this->model->object_name(), TRUE);

			if (isset($errors['_external']))
			{
				$errors = Arr::merge($errors['_external'], $errors);
			}

			$this->errors = Arr::merge($errors, $original);
		}
		else if (is_array($errors))
		{
			$this->errors = Arr::merge($errors, $original);
		}

		return $this;
	}

	public function __toString()
	{
		if (count($this->errors) > 0)
		{
			return '<div'.HTML::attributes(['class' => 'alert alert-warning']).'>'.__($this->message_errors).'</div>';
		}

		if ($this->model->saved())
		{
			return '<div'.HTML::attributes(['class' => 'alert alert-success']).'>'.__($this->message_success).'</div>';
		}

		return '';
	}

	public function value($name = NULL)
	{
		if ($this->request->method() === HTTP_Request::POST)
		{
			return Arr::get($this->post, $name);
		}
		else if ($this->model->loaded())
		{
			return $this->model->{$name};
		}

		return NULL;
	}

	public function has($name = NULL)
	{
		if (Arr::get($this->errors, $name))
			return ' has-error';

		return NULL;
	}

	public function helper($name)
	{
		if ($message = Arr::get($this->errors, $name))
			return '<span'.HTML::attributes(['class' => 'help-block']).'>'.(is_string($message) ? $message : 'unknown_error').'</span>';

		return NULL;
	}
}