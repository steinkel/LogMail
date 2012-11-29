<?php

App::uses('DebugTransport', 'Network/Email');

class DatabaseLogDebugTransport extends DebugTransport {

	public function send(CakeEmail $email) {
		$result = parent::send($email);
		$from = implode(',', (array)$email->from());
		$headers = $this->_headersToString($email->getHeaders(array('from', 'sender', 'replyTo', 'readReceipt', 'returnPath', 'to', 'cc', 'subject')));
		$to = implode(',', (array)$email->to());
		$subject = $email->subject();
		$body = $message = implode("\r\n", (array)$email->message());
		ClassRegistry::init('LogMail.Logmail')->saveLog($from, $to, $headers, $subject, $body);
		return $result;
	}
}