<?php

class Category extends Eloquent {

	protected $table = 'categories';

	public function tickets()
	{
		return $this->belongsToMany('Ticket', 'tickets_categories');
	}
}