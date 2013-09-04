<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Ticket Model
 *
 * @package    Support Tickets
 * @category   Model
 * @author     Birkir Gudjonsson (birkir.gudjonsson@gmail.com)
 * @copyright  (c) 2012 Birkir Gudjonsson
 * @licence    http://kohanaframework.org/licence
 */
class Model_Ticket extends ORM {

	/**
	 * @var array Has many relationship
	 */
	protected $_has_many = [
		'messages' => [
			'model' => 'Ticket_Message'
		],
		'categories' => [
			'through' => 'tickets_categories'
		]
	];

	/**
	 * @var array Belongs to relationship
	 */
	protected $_belongs_to = [
		'user' => []
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

	public function count_all()
	{
		$this->where('deleted_at', 'IS', NULL);
		return parent::count_all();
	}

	public function rules()
	{
		return [
			'title' => [
				['not_empty']
			],
			'message' => [
				['not_empty']
			],
			'status' => [
				['not_empty'],
				['digit']
			]
		];
	}

	public function status($type = NULL)
	{
		$codes = [
			0 => ['state' => 'warning', 'text' => 'unsolved'],
			1 => ['state' => 'success', 'text' => 'solved']
		];

		if (empty($type))
		{
			return $codes;
		}

		return __($codes[$this->status][$type]);
	}

} // End Ticket