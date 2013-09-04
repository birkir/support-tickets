<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Ticket Message Model
 *
 * @package    Support Tickets
 * @category   Model
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Model_Ticket_Message extends ORM {

	/**
	 * @var array Belongs to relationship
	 */
	protected $_belongs_to = [
		'ticket' => [],
		'user'   => []
	];

	public function find()
	{
		$this->where('deleted_at', 'IS', NULL);
		return parent::find();
	}

	public function find_all()
	{
		$this->where('deleted_at', 'IS', NULL);

		return parent::find_all();
	}

	public function rules()
	{
		return [
			'message' => [
				['not_empty']
			]
		];
	}

} // End Ticket Message