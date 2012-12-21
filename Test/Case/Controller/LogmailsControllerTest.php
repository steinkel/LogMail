<?php
/* Logmails Test cases generated on: 2012-12-21 21:12:57 : 1356121857*/
App::import('Controller', 'LogMail.Logmails');

App::import('Lib', 'Templates.AppControllerTestCase');
class LogmailsControllerTestCase extends AppControllerTestCase {
/**
 * Autoload entrypoint for fixtures dependecy solver
 *
 * @var string
 * @access public
 */
	public $plugin = 'app';

/**
 * Test to run for the test case (e.g array('testFind', 'testView'))
 * If this attribute is not empty only the tests from the list will be executed
 *
 * @var array
 * @access protected
 */
	protected $_testsToRun = array();

/**
 * Start Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function startTest($method) {
		parent::startTest($method);
		$this->Logmails = $this->generate(
			'Logmails', array(
			  'methods' => array(
				'redirect'),
			  'components' => array(
				'Session')));
		$this->Logmails->constructClasses();
		$this->Logmails->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array());
		$fixture = new LogmailFixture();
		$this->record = array('Logmail' => $fixture->records[0]);
	}

/**
 * End Test callback
 *
 * @param string $method
 * @return void
 * @access public
 */
	public function endTest($method) {
		parent::endTest($method);
		unset($this->Logmails);
		ClassRegistry::flush();
	}

/**
 * Convenience method to assert Flash messages
 *
 * @return void
 * @access public
 */
	// public function assertFlash($message) {
		// $flash = $this->Logmails->Session->read('Message.flash');
		// $this->assertEqual($flash['message'], $message);
		// $this->Logmails->Session->delete('Message.flash');
	// }

/**
 * Test object instances
 *
 * @return void
 * @access public
 */
	public function testInstance() {
		$this->assertInstanceOf('LogmailsController', $this->Logmails);
	}



	
}
