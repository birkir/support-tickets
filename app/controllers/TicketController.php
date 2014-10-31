<?php

class TicketController extends \BaseController {

	public function showList($category = NULL)
	{
		if ($category)
		{
			$category = Category::findOrFail($category);
		}

		// Find all categories order by position
		$categories = Category::orderBy('position', 'ASC')->get();

		// Setup category list view
		$categoryView = View::make('category/list')
		->with('categories', $categories)
		->with('selected', $category);

		// Get all tickets
		if ($category)
		{
			$tickets = $category->tickets()->orderBy('created_at', 'DESC')->get();
		}
		else
		{
			$tickets = Ticket::orderBy('created_at', 'DESC')->get();
		}

		// List tickets view
		return View::make('ticket/list')
		->with('tickets', $tickets)
		->with('categoryView', $categoryView);
	}

	public function showDetail($id = 0)
	{
		$ticket = Ticket::findOrFail($id);

		$messageView = View::make('ticket.message')
		->with('ticket', $ticket);

		return View::make('ticket.detail')
		->with('ticket', $ticket)
		->with('messageView', $messageView);
	}

	public function doMessage($id = 0)
	{
		$ticket = Ticket::findOrFail($id);

		$rules = array(
			'message'    => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('ticket/'.$ticket->id)
				->withErrors($validator)
				->withInput();
		}
		else
		{
			$message = TicketMessage::create([
				'message' => Input::get('message')
			]);

			// Set message user and ticket
			$message->user()->associate(Auth::user());
			$ticket->messages()->save($message);
			$message->save();

			return Redirect::to('ticket/'.$ticket->id);
		}
	}

	public function doDeleteTicket($id = 0)
	{
		$ticket = Ticket::findOrFail($id);

		if (Auth::check() AND (Auth::user()->hasRole('admin') OR Auth::user()->id === $ticket->user_id))
		{
			$ticket->delete();
		}

		return Redirect::to('tickets');
	}

	public function doDeleteMessage($id = 0)
	{
		$message = TicketMessage::findOrFail($id);

		$ticket = $message->ticket_id;

		if (Auth::check() AND (Auth::user()->hasRole('admin') OR Auth::user()->id === $message->user_id))
		{
			$message->delete();
		}

		return Redirect::to('ticket/'.$ticket);
	}


}
