<?php

class TicketMessage extends Eloquent {

	protected $table = 'ticket_messages';

	protected $fillable = array('message');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function ticket()
	{
		return $this->belongsTo('Ticket');
	}
}