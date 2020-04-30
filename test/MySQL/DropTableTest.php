<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableTest extends TestCase
{
    public function testNames()
    {
        $obj = new DropTable('foo');
        $this->assertSame(false, $obj->hasDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());

        $obj = new DropTable('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame(true, $obj->hasDatabaseName());
        $this->assertSame('bar', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());
    }

    public function testIfExists()
    {
        $obj = new DropTable('foo');
        $this->assertSame(false, $obj->getIfExists());

        $obj->setIfExists();
        $this->assertSame(true, $obj->getIfExists());

        $obj->setIfExists(false);
        $this->assertSame(false, $obj->getIfExists());
    }

    public function testBuild()
    {
        $obj = new DropTable('foo');
        $this->assertSame('DROP TABLE `foo`', $obj->getBuild());

        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE `bar`.`foo`', $obj->getBuild());

        $obj = new DropTable('foo');
        $obj->setIfExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`', $obj->getBuild());

        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE IF EXISTS `bar`.`foo`', $obj->getBuild());
    }
}
