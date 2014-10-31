<?php

class Ticket extends Eloquent {

	protected $table = 'tickets';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function messages()
	{
		return $this->hasMany('TicketMessage');
	}

	public function categories()
	{
		return $this->belongsToMany('Category', 'tickets_categories');
	}
}
