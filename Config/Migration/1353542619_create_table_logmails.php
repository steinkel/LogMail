<?php
class CreateTableLogmails extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'logmails' => array(
					'id' => array('type' => 'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
					'from' => array('type' => 'string', 'null' => false, 'default' => NULL),
					'to' => array('type' => 'text', 'null' => false, 'default' => NULL),
					'headers' => array('type' => 'text', 'null' => true, 'default' => NULL),
					'subject' => array('type' => 'text', 'null' => true, 'default' => NULL),
					'body' => array('type' => 'text', 'null' => true, 'default' => NULL),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'logmails'
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		return true;
	}
}
