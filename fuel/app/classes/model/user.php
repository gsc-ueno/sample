<?php

class Model_User extends \Orm\Model_Soft
{

	protected static $_properties = array(
		'id',
		'username',
		'password',
		'email',
		'group',
		'person',
		'corp_id',
		'last_login',
		'login_hash',
		'profile_fields',
		'deleted_at',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events'          => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_conditions = array(
		'order_by' => array('group' => 'asc'),
	);

	protected static $_soft_delete = array(
		'deleted_field'   => 'deleted_at',
		'mysql_timestamp' => false,
	);

	protected static $_belongs_to = [
		'corp'    => [
			'model_to'       => 'Model_Corp',
			'key_from'       => 'corp_id',
			'key_to'         => 'id',
			'cascade_save'   => false,
			'cascade_delete' => false,
		],
	];
}
