<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Category Model
 *
 * @package    Support Tickets
 * @category   Model
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Model_Category extends ORM {

	/**
	 * @var array Has many relationship
	 */
	protected $_has_many = [
		'tickets' => [
			'through' => 'tickets_categories'
		]
	];

} // End Category