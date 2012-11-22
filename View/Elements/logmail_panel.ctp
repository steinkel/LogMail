<h2> <?php echo __d('logmail', 'Latest Emails'); ?></h2>
<?php 
$content['Latest Emails'] = ClassRegistry::init('LogMail.Logmail')->find('all', array(
	'limit' => 10,
	'order' => 'created DESC'
));
echo $this->Toolbar->makeNeatArray($content); 

?>