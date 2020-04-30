<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateDatabaseTest extends TestCase
{
    public function testNames()
    {
        $obj = new ShowCreateDatabase('foo');
        $this->assertSame('foo', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getName());
    }

    public function testBuild()
    {
        $obj = new ShowCreateDatabase('foo');
        $this->assertSame('SHOW CREATE DATABASE `foo`', $obj->getBuild());
    }
}
