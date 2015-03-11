<?php
//namespace phpunit;
require_once dirname(__FILE__).'/../'.'AutoLoad.php';
require_once "vendor/autoload.php";

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

class DBTestCase extends PHPUnit_Framework_TestCase
{
    public $db;
}

class DBBadTestCase extends DBTestCase
{


    function setUp()
    {
        $mockDB = $this->getMockBuilder('mysqli')->getMock();
        $mockDB->method('query')
            ->willReturn(false);

        $mockDB->method('prepare')
            ->willReturn(false);

        $mockDB->method('multi_query');

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
    protected $mockDb;

    function setUp()
    {

        $this->mockDB = $this->getMockBuilder('mysqli')
            ->setMethods(array('query','prepare','multi_query'))
            ->getMock();

        $db = new MysqlDB_Proxy($this->mockDB);
        $this->db = new Database\DBClass($db,null);
    }

    function testGoodQuery()
    {
        $this->mockDB
            ->expects($this->once())
            ->method('query')
            ->will($this->returnValue(true));

        $this->db->query("null");
    }

    function testGoodPrepare()
    {
        $this->mockDB
            ->expects($this->once())
            ->method('prepare')
            ->will($this->returnValue(true));

        $this->db->prepare("null");
    }

    function testGoodMultiQuery()
    {
        $this->mockDB
            ->expects($this->once())
            ->method('multi_query')
            ->will($this->returnValue(true));

        $this->db->multi_query("null");
    }
}

    $suite = new PHPUnit_Framework_TestSuite('DBGoodTestCase');
    $suite->addTestSuite("DBBadTestCase");
    PHPUnit_TextUI_TestRunner::run($suite);

?>