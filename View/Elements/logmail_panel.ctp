<?php 
	echo $this->Html->tag('h2', __d('logmail', 'Latest HTML Emails, most recent first'));

	$niceLatestEmails = array();
	echo "<ul class='neat-array depth-0'>";
	foreach ($latestEmails as $i => $email) {
		$email = $email['Logmail'];
		$niceKey = $i . ' - ' . $email['from'] . ' >> ' . $email['to'] . ' :: ' . $email['subject'];
		preg_match('/<body>(.*?)<\/body>/s', html_entity_decode($email['body']), $matches);
		if (!empty($matches[1])) {
			$niceLatestEmails[$niceKey]['HTML'] = array($matches[1]);
		} else {
			$niceLatestEmails[$niceKey]['HTML'] = array('No HTML email detected, check raw messages for text email');
		}
		$niceLatestEmails[$niceKey]['raw'] = array($email['body']);
		echo '<li>';
		echo $niceKey;
			echo "<ul class='neat-array depth-1'>";
			echo '<li>';
			echo $niceLatestEmails[$niceKey]['HTML'][0];
			echo '</li>';
			echo "</ul>";
		echo '</li>';
	}
	echo "</ul>";
	
	echo $this->Html->tag('h2', __d('logmail', 'Latest Emails in raw format, most recent first'));
	$content['Latest Emails'] = $niceLatestEmails;
	echo $this->Toolbar->makeNeatArray($content);