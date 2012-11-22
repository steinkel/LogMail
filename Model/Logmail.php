<?php

App::uses('LogMailAppModel', 'LogMail.Model');

class Logmail extends LogMailAppModel {
/**
 * Validation parameters - initialized in constructor
 *
 * @var array
 * @access public
 */
	public $validate = array();


/**
 * Constructor
 *
 * @param mixed $id Model ID
 * @param string $table Table name
 * @param string $ds Datasource
 * @access public
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->validate = array(
			'sender' => array(
				'notempty' => array('rule' => array('notempty'), 'required' => true, 'allowEmpty' => false, 'message' => __('Please enter a Sender', true))),
			'recipient' => array(
				'notempty' => array('rule' => array('notempty'), 'required' => true, 'allowEmpty' => false, 'message' => __('Please enter a Recipient', true))),
		);
	}

	
/**
 * Adds a new record to the database
 *
 * @param array post data, should be Contoller->data
 * @return array
 * @access public
 */
	public function add($data = null) {
		if (!empty($data)) {
			$this->create();
			$result = $this->save($data);
			if ($result !== false) {
				$this->data = array_merge($data, $result);
				return true;
			} else {
				throw new OutOfBoundsException(__('Could not save the logmail, please check your inputs.', true));
			}
			return $return;
		}
	}

/**
 * Edits an existing Logmail.
 *
 * @param string $id, logmail id 
 * @param array $data, controller post data usually $this->data
 * @return mixed True on successfully save else post data as array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function edit($id = null, $data = null) {
		$logmail = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($logmail)) {
			throw new OutOfBoundsException(__('Invalid Logmail', true));
		}
		$this->set($logmail);

		if (!empty($data)) {
			$this->set($data);
			$result = $this->save(null, true);
			if ($result) {
				$this->data = $result;
				return true;
			} else {
				return $data;
			}
		} else {
			return $logmail;
		}
	}

/**
 * Returns the record of a Logmail.
 *
 * @param string $id, logmail id.
 * @return array
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function view($id = null) {
		$logmail = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id)));

		if (empty($logmail)) {
			throw new OutOfBoundsException(__('Invalid Logmail', true));
		}

		return $logmail;
	}

/**
 * Validates the deletion
 *
 * @param string $id, logmail id 
 * @param array $data, controller post data usually $this->data
 * @return boolean True on success
 * @throws OutOfBoundsException If the element does not exists
 * @access public
 */
	public function validateAndDelete($id = null, $data = array()) {
		$logmail = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)));

		if (empty($logmail)) {
			throw new OutOfBoundsException(__('Invalid Logmail', true));
		}

		$this->data['logmail'] = $logmail;
		if (!empty($data)) {
			$data['Logmail']['id'] = $id;
			$tmp = $this->validate;
			$this->validate = array(
				'id' => array('rule' => 'notEmpty'),
				'confirm' => array('rule' => '[1]'));

			$this->set($data);
			if ($this->validates()) {
				if ($this->delete($data['Logmail']['id'])) {
					return true;
				}
			}
			$this->validate = $tmp;
			throw new Exception(__('You need to confirm to delete this Logmail', true));
		}
	}

/**
 * 
 * @param AbstractTransport $transport
 * @param type $email
 */	
	public function saveLog($from, $to, $headers, $body) {
		$data = array();
		$data[$this->alias]['sender'] = $from;
		$data[$this->alias]['recipient'] = $to;
		$data[$this->alias]['headers'] = $headers;
		$data[$this->alias]['body'] = $body;
		return $this->add($data);
	}	
}
