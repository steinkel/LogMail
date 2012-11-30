# CakePHP LogMail Plugin

LogMail is a quick and dirty plugin to store all mail sent to the database and display latest emails in a DebugKit Panel

## Requirements

The master branch has the following requirements:

* CakePHP 2.1.3 or greater.
* PHP 5.3.0 or greater.
* DebugKit plugin
* Migrations plugin

## Installation

* Setup DebugKit
* Run Migration Console/cake Migrations.migration run all --plugin LogMail
* Add to AppController
    'DebugKit.Toolbar'=> array(
		'panels' => array('LogMail.LogMail')),
* Use this config in your email.php file
		public $logdebug = array(
			'transport' => 'LogMail.DatabaseLogDebug',
			'from' => 'hey@example.com'
		);

# Documentation

# Todo
* Add unit tests
* display HTML emails correctly
* use cache instead of the database for store the emails ?


