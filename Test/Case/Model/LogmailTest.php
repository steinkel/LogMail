<?php
/* Logmail Test cases generated on: 2012-11-22 01:11:09 : 1353542589*/
App::import('Model', 'LogMail.Logmail');

App::import('Lib', 'Templates.AppTestCase');
class LogmailTestCase extends AppTestCase {
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
		$this->Logmail = ClassRegistry::init('Logmail');
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
		unset($this->Logmail);
		ClassRegistry::flush();
	}

/**
 * Test validation rules
 *
 * @return void
 * @access public
 */
	public function testValidation() {
		$this->assertValid($this->Logmail, $this->record);

		// Test mandatory fields
		$data = array('Logmail' => array('id' => 'new-id'));
		$expectedErrors = array(); // TODO Update me with mandatory fields
		$this->assertValidationErrors($this->Logmail, $data, $expectedErrors);

		// TODO Add your specific tests below
		$data = $this->record;
		//$data[Logmail]['title'] = str_pad('too long', 1000);
		//$expectedErrors = array('title');
		$this->assertValidationErrors($this->Logmail, $data, $expectedErrors);
	}

/**
 * Test adding a Logmail 
 *
 * @return void
 * @access public
 */
	public function testAdd() {
		$data = $this->record;
		unset($data['Logmail']['id']);
		$result = $this->Logmail->add($data);
		$this->assertTrue($result);
		
		try {
			$data = $this->record;
			unset($data['Logmail']['id']);
			//unset($data['Logmail']['title']);
			$result = $this->Logmail->add($data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
		
	}

/**
 * Test editing a Logmail 
 *
 * @return void
 * @access public
 */
	public function testEdit() {
		$result = $this->Logmail->edit('logmail-1', null);

		$expected = $this->Logmail->read(null, 'logmail-1');
		$this->assertEqual($result['Logmail'], $expected['Logmail']);

		// put invalidated data here
		$data = $this->record;
		//$data['Logmail']['title'] = null;

		$result = $this->Logmail->edit('logmail-1', $data);
		$this->assertEqual($result, $data);

		$data = $this->record;

		$result = $this->Logmail->edit('logmail-1', $data);
		$this->assertTrue($result);

		$result = $this->Logmail->read(null, 'logmail-1');

		// put record specific asserts here for example
		// $this->assertEqual($result['Logmail']['title'], $data['Logmail']['title']);

		try {
			$this->Logmail->edit('wrong_id', $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test viewing a single Logmail 
 *
 * @return void
 * @access public
 */
	public function testView() {
		$result = $this->Logmail->view('logmail-1');
		$this->assertTrue(isset($result['Logmail']));
		$this->assertEqual($result['Logmail']['id'], 'logmail-1');

		try {
			$result = $this->Logmail->view('wrong_id');
			$this->fail('No exception on wrong id');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test ValidateAndDelete method for a Logmail 
 *
 * @return void
 * @access public
 */
	public function testValidateAndDelete() {
		try {
			$postData = array();
			$this->Logmail->validateAndDelete('invalidLogmailId', $postData);
		} catch (OutOfBoundsException $e) {
			$this->assertEqual($e->getMessage(), 'Invalid Logmail');
		}
		try {
			$postData = array(
				'Logmail' => array(
					'confirm' => 0));
			$result = $this->Logmail->validateAndDelete('logmail-1', $postData);
		} catch (Exception $e) {
			$this->assertEqual($e->getMessage(), 'You need to confirm to delete this Logmail');
		}

		$postData = array(
			'Logmail' => array(
				'confirm' => 1));
		$result = $this->Logmail->validateAndDelete('logmail-1', $postData);
		$this->assertTrue($result);
	}
	
}
