<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableTest extends TestCase
{
    public function testBuild()
    {
        $obj = new DropTable('foo');
        $this->assertSame('DROP TABLE `foo`', $obj->getBuild());

        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE `bar`.`foo`', $obj->getBuild());

        $obj = new DropTable('foo');
        $obj->ifExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`', $obj->getBuild());

        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE IF EXISTS `bar`.`foo`', $obj->getBuild());
    }
}
