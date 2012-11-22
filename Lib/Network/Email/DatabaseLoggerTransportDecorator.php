<?php

App::uses('AbstractTransport', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

class DatabaseLoggerTransportDecorator extends AbstractTransport {

	protected $_transport;

	public function __construct(AbstractTransport $transport) {
        $this->_transport = $transport;
    }	

	public function send(CakeEmail $email) {
		$this->_transport->send($email);
		CakeLog::write(LOG_DEBUG, __FILE__ . '|' . __FUNCTION__ . ':' . __LINE__ . ' :--> ' . print_r($email, true));
	}
}