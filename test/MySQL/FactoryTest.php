<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function test()
    {
        $this->assertEquals(Create::database('foo'), new CreateDatabase('foo'));
        $this->assertEquals(Drop::database('foo'), new DropDatabase('foo'));
        $this->assertEquals(Create::table('foo'), new CreateTable('foo'));
        $this->assertEquals(Create::table('foo', 'bar'), new CreateTable('foo', 'bar'));
        $this->assertEquals(Drop::table('foo'), new DropTable('foo'));
        $this->assertEquals(Drop::table('foo', 'bar'), new DropTable('foo', 'bar'));
    }
}
