<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function test()
    {
        $this->assertEquals(Create::database('foo'), new CreateDatabase('foo'));
        $this->assertEquals(Create::table('foo'), new CreateTable('foo'));
        $this->assertEquals(Drop::database('foo'), new DropDatabase('foo'));
        $this->assertEquals(Drop::table('foo'), new DropTable('foo'));
    }
}
