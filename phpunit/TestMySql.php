<?php
//namespace phpunit;
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';
require_once "vendor/autoload.php";

class BadMockDB
{
    public function query($query)
    {
        return false;
    }

    public function prepare($query)
    {
        return false;
    }

    public function multi_query($query)
    {
        return false;
    }

    public function close()
    {

    }

    public function getLastError()
    {
       return "Last Error";
    }

    public function getLastErrno()
    {
       return "Last Errno";
    }
}

class GoodMockDB
{
    public function query($query)
    {
        return true;
    }

    public function prepare($query)
    {
        return true;
    }

    public function multi_query($query)
    {
        return true;
    }

    public function close()
    {

    }

    public function getLastError()
    {
       return "Last Error";
    }

    public function getLastErrno()
    {
       return "Last Errno";
    }
}

class DBTestCase extends PHPUnit_Framework_TestCase
{
	public $db;
	function __construct($name)
	{
		parent::__construct($name);
	}
}

class DBBadTestCase extends DBTestCase
{
    function __construct($name)
    {
        parent::__construct($name);
    }

    function setUp()
    {
        $this->db = new Database\DBClass();
        $this->db->setDB(new BadMockDB());
    }

    
    function testBadQuery()
    {
        $this->setExpectedException('RuntimeException');
        $this->db->query("null");
    }

    function testBadPrepare()
    {
        $this->setExpectedException('RuntimeException');
        $this->db->prepare("null");
    }

    function testBadMultiQuery()
    {
        $this->setExpectedException('RuntimeException');
        $this->db->multi_query("null");
    }
}

class DBGoodTestCase extends DBTestCase
{
    function _construct($name)
    {
         parent::__construct($name);
    }

    function setUp()
    {
        $this->db = new Database\DBClass();
        $this->db->setDB(new GoodMockDB());
    }

    
    function testGoodQuery()
    {
        $this->assertNotNull($this->db->query("null"));
    }

    function testGoodPrepare()
    {
        $this->assertNotNull($this->db->prepare("null"));
    }

    function testGoodMultiQuery()
    {
        $this->assertNotNull($this->db->multi_query("null"));
    }
}

    $suite = new PHPUnit_Framework_TestSuite('DBGoodTestCase');
    $suite->addTestSuite("DBBadTestCase");
    PHPUnit_TextUI_TestRunner::run($suite);

?>