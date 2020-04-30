<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateTableTest extends TestCase
{
    public function testNames()
    {
        $obj = new ShowCreateTable('foo');
        $this->assertSame(false, $obj->hasDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());

        $obj = new ShowCreateTable('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame(true, $obj->hasDatabaseName());
        $this->assertSame('bar', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());

        $obj->setDatabaseName();
        $this->assertSame(false, $obj->hasDatabaseName());
    }

    public function testBuild()
    {
        $obj = new ShowCreateTable('foo');
        $this->assertSame('SHOW CREATE TABLE `foo`', $obj->getBuild());

        $obj->setDatabaseName('bar');
        $this->assertSame('SHOW CREATE TABLE `bar`.`foo`', $obj->getBuild());
    }
}
