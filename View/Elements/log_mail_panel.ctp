<?php 
	$niceLatestEmails = array();
	foreach ($latestEmails as $i => $email) {
		$email = $email['Logmail'];
		$niceKey = $i . ' - ' . $email['from'] . ' >> ' . $email['to'] . ' :: ' . $email['subject'];
		$niceKey .= ' >> ' . $this->Html->link(__('Open email in new window'), array(
			'plugin' => 'log_mail',
			'controller' => 'logmails',
			'action' => 'view',
			$email['id']
		), array('target' => '_blank'));
		$niceLatestEmails[$niceKey]['raw'] = array($email['body']);
	}
	
	echo $this->Html->tag('h2', __d('logmail', 'Latest Emails in raw format, most recent first'));
	$content['Latest Emails'] = $niceLatestEmails;
	echo $this->Toolbar->makeNeatArray($content);