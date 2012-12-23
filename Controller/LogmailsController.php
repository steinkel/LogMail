<?php

App::uses('LogMailAppController', 'LogMail.Controller');

class LogmailsController extends LogMailAppController {
	
/**
 * Prevent access if debug == 0
 */	
	public function beforeFilter() {
		if (Configure::read('debug') === 0) {
			$this->_stop();
		}
		if ($this->Auth) {
			$this->Auth->allow(array('view'));
		}
	}

/**
 * Display html content for a Logmail
 * @param type $id
 * @return type
 */	
	public function view($id) {
		$email = $this->Logmail->findById($id);
		if (empty($email['Logmail'])) {
			return NotFoundException(__('Mail was not found'));
		}
		$email = $email['Logmail'];
		// strip the html content
		preg_match('/<html.*>(.*?)<\/html>/s', html_entity_decode($email['body']), $matches);
		$body = __('No HTML email detected, check raw messages for text email');
		if (!empty($matches[0])) {
			$body = $matches[0];
		}
		$this->set('body', $body);
	}
}
