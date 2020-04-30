<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTest extends TestCase
{
    public function testFactories()
    {
        $obj1 = new DropDatabase('foo');
        $obj2 = Drop::database('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new DropDatabase('foo');
        $obj1->setIfExists();
        $obj2 = Drop::databaseIfExists('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new DropTable('foo');
        $obj2 = Drop::table('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new DropTable('foo');
        $obj1->setIfExists();
        $obj2 = Drop::tableIfExists('foo');
        $this->assertEquals($obj1, $obj2);
    }
}
