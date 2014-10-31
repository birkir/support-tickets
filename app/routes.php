<?php


Route::get('tickets', array('as' => 'tickets', 'uses' => 'TicketController@showList'));
Route::get('tickets/category/{id}', array('as' => 'tickets.category', 'uses' => 'TicketController@showList'));
Route::get('ticket/{id}', array('as' => 'ticket.details', 'uses' => 'TicketController@showDetail'));
Route::post('ticket/{id}', array('as' => 'ticket.message', 'uses' => 'TicketController@doMessage'));
Route::get('account/login', array('as' => 'account.login', 'uses' => 'AccountController@showLogin'));
Route::post('account/login', 'AccountController@doLogin');
Route::get('account/logout', 'AccountController@showLogout');
Route::get('account/register', 'AccountController@showRegister');
Route::get('ticket/{id}/delete', 'TicketController@doDeleteTicket');
Route::get('ticket/message/{id}/delete', 'TicketController@doDeleteMessage');
