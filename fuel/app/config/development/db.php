<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=sample_dev',
			'username'   => 'sample_dev',
			'password'   => 'sample_dev',
		),
		'profiling'  => true,
	),
);
