<?php
class LogMailPanel extends DebugPanel {
	var $plugin = 'LogMail';

/**
 * Load the latest emails from database
 * @param Controller $controller
 */	
	public function beforeRender(Controller $controller) {
		$latestEmails = ClassRegistry::init('LogMail.Logmail')->find('all', array(
			'limit' => 10,
			'order' => 'created DESC'
		));
		$controller->set('latestEmails', $latestEmails);
	}
}