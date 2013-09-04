<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Ticket Controller
 *
 * @package    Support Tickets
 * @category   Controller
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Controller_Ticket extends Controller_Template {

	/**
	 * Proxy page to category view with no cat selected
	 *
	 * @return void
	 */
	public function action_Index()
	{
		$this->view = Request::factory('Ticket/Category')->execute();
	}

	/**
	 * List tickets by given category id
	 *
	 * @return void
	 */
	public function action_Category()
	{
		// setup view
		$this->view = View::factory('Ticket/List')
		->bind('items', $items)
		->bind('category', $category);

		// get category
		$category = ORM::factory('Category', $this->request->param('id'));

		// load ticket model
		$model = ($category->loaded() ? $category->tickets : ORM::factory('Ticket'));

		// orm query
		$items = $model
		->order_by('created_at', 'DESC')
		->find_all();
	}

	/**
	 * Display ticket details with messages
	 *
	 * @return void
	 */
	public function action_Detail()
	{
		// load ticket from database
		$item = ORM::factory('Ticket', $this->request->param('id'));

		// check for ticket existance
		if ( ! $item->loaded())
			return $this->not_found('Could not find Ticket', 'Please go back to ticket list and find a ticket.');

		// setup view
		$this->view = View::factory('Ticket/Detail')
		->set('item', $item)
		->set('verified', $this->auth->logged_in('verified'))
		->set('owner', $this->user->id === $item->user->id)
		->set('admin', $this->auth->logged_in('admin'))
		->bind('messages', $messages);

		// get ticket message responses
		$messages = $item->messages
		->order_by('created_at', 'ASC')
		->find_all();
	}

	/**
	 * Show message form and process controller
	 *
	 * @return void
	 */
	public function action_Message()
	{
		// get initial request (as we load it via HMVC)
		$request = Request::initial();

		// setup view
		$this->view = View::factory('Ticket/Message/Fieldset')
		->set('admin', $this->auth->logged_in('admin'))
		->bind('form', $form)
		->bind('ticket', $ticket);

		// load ticket from database
		$ticket = ORM::factory('Ticket', $this->request->param('id'));

		// factory orm item
		$item = ORM::factory('Ticket_Message');

		// create form
		$form = Form::factory($item);

		// on form submit
		if ($request->method() === HTTP_Request::POST)
		{
			// set ticket and user to item
			$item->ticket_id = $ticket->id;
			$item->user_id = $this->user->id;
			$item->values($request->post(), ['message']);

			// process ticket status if admin
			if ($this->auth->logged_in('admin') AND $request->post('status') != '')
			{
				$ticket->status = $request->post('status');
				$ticket->save();
			}

			try
			{
				// validate and save item
				$item->save();

			}
			catch (ORM_Validation_Exception $e)
			{
				// attach errors to form
				$form->attach($e);
			}
		}
	}

	/**
	 * Show ticket form and process controller
	 *
	 * @return void
	 */
	public function action_Create()
	{
		// setup view
		$this->view = View::factory('Ticket/Fieldset')
		->bind('form', $form)
		->set('categories', ORM::factory('Category')->find_all()->as_array('id', 'name'));

		// create ticket model
		$item = ORM::factory('Ticket');

		// factory an form
		$form = Form::factory($item);
		$form->message_success .= '<br>'.HTML::anchor('Ticket', __('Go back'));

		// on form submit
		if ($this->request->method() === HTTP_Request::POST)
		{
			// get post data
			$data = $this->request->post();
			$data['status'] = 0;

			// set values to ORM
			$item->values($data);

			// validate categories
			foreach (Arr::get($data, 'categories', []) as $i => $category)
			{
				$data['categories'][$i] = ORM::factory('Category', $category);

				if ( ! $data['categories'][$i]->loaded())
				{
					$form->attach(['categories' => 'invalid category']);
				}
			}

			// we need at least 1 category
			if (empty($data['categories']))
			{
				$form->attach(['categories' => 'minimum 1 category is required']);
			}

			try
			{
				// check validation
				$item->check();

				// proceed if form is valid
				if ($form->valid())
				{
					// save item
					$item->save();

					// loop through categories
					foreach ($data['categories'] as $category)
					{
						// add the relation
						$item->add('categories', $category);
					}
				}
			}
			catch (ORM_Validation_Exception $e)
			{
				// attach errors to form
				$form->attach($e);
			}
		}
	}

	/**
	 * Delete ticket and redirect
	 *
	 * @uses   HTTP
	 * @return void
	 */
	public function action_Delete()
	{
		// load item
		$item = ORM::factory('Ticket', $this->request->param('id'));

		if ( ! $item->loaded())
			$this->not_found('Could not find ticket to delete. Already deleted maybe?');

		$item->deleted_at = date('Y-m-d H:i:s');
		$item->save();

		HTTP::redirect('Ticket');
	}

	/**
	 * Delete ticket message and redirect
	 *
	 * @uses   HTTP
	 * @return void
	 */
	public function action_Delete_Message()
	{
		// load item
		$item = ORM::factory('Ticket_Message', $this->request->param('id'));

		if ( ! $item->loaded())
			$this->not_found('Could not find ticket message to delete. Already deleted maybe?');

		$ticket_id = $item->ticket->id;

		$item->deleted_at = date('Y-m-d H:i:s');
		$item->save();

		HTTP::redirect('Ticket/Detail/'.$ticket_id);
	}

} // End Ticket