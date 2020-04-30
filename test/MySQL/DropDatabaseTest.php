<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropDatabaseTest extends TestCase
{
    public function testNames()
    {
        $obj = new DropDatabase('foo');
        $this->assertSame('foo', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getName());
    }

    public function testIfExists()
    {
        $obj = new DropDatabase('foo');
        $this->assertSame(false, $obj->getIfExists());

        $obj->ifExists();
        $this->assertSame(true, $obj->getIfExists());
    }

    public function testBuild()
    {
        $obj = new DropDatabase('foo');
        $this->assertSame('DROP DATABASE `foo`', $obj->getBuild());

        $obj->ifExists();
        $this->assertSame('DROP DATABASE IF EXISTS `foo`', $obj->getBuild());
    }
}
