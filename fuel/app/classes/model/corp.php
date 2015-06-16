<?php

class Model_Corp extends \Orm\Model_Soft
{

	protected static $_properties = array(
		'id'				=> [],
		'name'				=> [
			'label'				=> '会社名',
			'validation'		=> [
				'required',
				'max_length' => [255],
			],
			'form'				=> [
				'type'				=> 'text',
				'attribute'			=> ['class' => 'form-control'],
			],
		],
		'deleted_at'		=> [],
		'created_at'		=> [],
		'updated_at'		=> [],
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events'          => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	protected static $_conditions = array(
		'order_by' => array('id' => 'asc'),
	);
	protected static $_soft_delete = array(
		'deleted_field'   => 'deleted_at',
		'mysql_timestamp' => true,
	);

	public static function create_options()
	{
		$corps = static::find('all');
		$data = [];
		foreach ($corps as $corp)
		{
			$data[$corp->id] = $corp->name;
		}
		return $data;
	}
}
