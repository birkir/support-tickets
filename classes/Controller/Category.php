<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Category Controller
 *
 * @package    Support Tickets
 * @category   Controller
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Controller_Category extends Controller_Template {

	/**
	 * Redirect to ticket page
	 *
	 * @uses   HTTP
	 * @return void
	 */
	public function action_Index()
	{
		HTTP::redirect('Ticket');
	}

	/**
	 * List available categories by its position
	 *
	 * @uses   HTTP
	 * @return void
	 */
	public function action_List()
	{
		// setup categories view
		$this->view = View::factory('Category/List')
		->bind('items', $items)
		->set('selected', $this->request->param('id'));

		// get all categories
		$items = ORM::factory('Category')
		->order_by('position', 'ASC')
		->find_all();
	}

} // End Category