<?php 
	echo $this->Html->tag('h2', __d('logmail', 'Latest Emails, most recent first'));

	$niceLatestEmails = array();
	foreach ($latestEmails as $i => $email) {
		$email = $email['Logmail'];
		$niceKey = $i . ' - ' . $email['from'] . ' >> ' . $email['to'] . ' :: ' . $email['subject'];
		$niceLatestEmails[$niceKey] = array('body' => $email['body']);
	}

$content['Latest Emails'] = $niceLatestEmails;
echo $this->Toolbar->makeNeatArray($content);