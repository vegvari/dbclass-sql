<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testFactories()
    {
        $obj1 = new CreateDatabase('foo');
        $obj2 = Create::database('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new CreateDatabase('foo');
        $obj1->setIfNotExists();
        $obj2 = Create::databaseIfNotExists('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new CreateTable('foo');
        $obj2 = Create::table('foo');
        $this->assertEquals($obj1, $obj2);

        $obj1 = new CreateTable('foo');
        $obj1->setIfNotExists();
        $obj2 = Create::tableIfNotExists('foo');
        $this->assertEquals($obj1, $obj2);
    }
}
