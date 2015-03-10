<?php
//namespace phpunit;
require_once $_SERVER['DOCUMENT_ROOT'].'/AddressBook/'.'AutoLoad.php';
require_once "vendor/autoload.php";

class DBTestCase extends PHPUnit_Framework_TestCase
{
	public $db;
	function __construct($name)
	{
		parent::__construct($name);
	}
}

class MysqlDB_Proxy extends Database\Adapter\MySqlDB
{
    public function getLastError()
    {
        return "Last Error";
    }

    public function getLastErrno()
    {
        return "Last Errno";
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
        $mockDB = $this->getMockBuilder('mysqli')->getMock();
        $mockDB->method('query')
            ->willReturn(false);

        $mockDB->method('prepare')
            ->willReturn(false);

        $mockDB->method('multi_query')
            ->willReturn(false);

        $db = new MysqlDB_Proxy($mockDB);
        $this->db = new Database\DBClass($db,null);
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

        $mockDB = $this->getMockBuilder('mysqli')->getMock();
        $mockDB->method('query')
               ->willReturn(true);

        $mockDB->method('prepare')
               ->willReturn(true);

        $mockDB->method('multi_query')
               ->willReturn(true);

        $db = new MysqlDB_Proxy($mockDB);
        $this->db = new Database\DBClass($db,null);
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