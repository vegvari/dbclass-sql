<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropDatabaseTest extends TestCase
{
    public function testBuild()
    {
        $obj = new DropDatabase('foo');
        $this->assertSame('DROP DATABASE `foo`', $obj->getBuild());

        $obj->ifExists();
        $this->assertSame('DROP DATABASE IF EXISTS `foo`', $obj->getBuild());
    }
}
