<h2> <?php echo __d('logmail', 'Latest Emails'); ?></h2>
<?php 
// we need to move that to the component and check why from / to is not working now
$content['Latest Emails'] = ClassRegistry::init('LogMail.Logmail')->find('all', array(
	'limit' => 10,
	'order' => 'created ASC'
));
echo $this->Toolbar->makeNeatArray($content); 

?>