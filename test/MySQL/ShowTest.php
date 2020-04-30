<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowTest extends TestCase
{
    public function testFactories()
    {
        $obj1 = new ShowCreateDatabase('foo');
        $obj2 = Show::createDatabase('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new ShowCreateTable('foo');
        $obj2 = Show::createTable('foo');
        $this->assertEquals($obj1, $obj2);
    }
}
