<?php
require_once "vendor/autoload.php";

trait AbstractTrait
{
    public function concreteMethod()
    {
        return $this->abstractMethod();
    }

    public abstract function abstractMethod();
}

class TraitClassTest extends PHPUnit_Framework_TestCase
{
    public function testConcreteMethod()
    {
        $mock = $this->getMockForTrait('AbstractTrait');

        $mock->expects($this->any())
            ->method('abstractMethod')
            ->will($this->returnValue(TRUE));

        $this->assertTrue($mock->concreteMethod());
    }
}

abstract class AbstractClass
{
    public function concreteMethod()
    {
        return $this->abstractMethod();
    }

    public abstract function abstractMethod();
}

class AbstractClassTest extends PHPUnit_Framework_TestCase
{
    public function testConcreteMethod()
    {
        $stub = $this->getMockForAbstractClass('AbstractClass');

        $stub->expects($this->any())
            ->method('abstractMethod')
            ->will($this->returnValue(TRUE));

        $this->assertTrue($stub->concreteMethod());
    }
}

$suite = new PHPUnit_Framework_TestSuite('TraitClassTest');
$suite->addTestSuite('AbstractClassTest');
PHPUnit_TextUI_TestRunner::run($suite);

?>
