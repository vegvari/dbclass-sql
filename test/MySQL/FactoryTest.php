<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function test_create()
    {
        $this->assertEquals(Create::database('foo'), new CreateDatabase('foo'));
        $this->assertEquals(Create::table('foo'), new CreateTable('foo'));
        $this->assertEquals(Create::table('foo', 'bar'), new CreateTable('foo', 'bar'));
    }

    public function test_drop()
    {
        $this->assertEquals(Drop::database('foo'), new DropDatabase('foo'));
        $this->assertEquals(Drop::table('foo'), new DropTable('foo'));
        $this->assertEquals(Drop::table('foo', 'bar'), new DropTable('foo', 'bar'));
    }

    public function test_int_column()
    {
        $this->assertEquals(Column::tinyint('foo', 1), new ColumnInt('foo', 'tinyint', 1));
        $this->assertEquals(Column::smallint('foo', 1), new ColumnInt('foo', 'smallint', 1));
        $this->assertEquals(Column::mediumint('foo', 1), new ColumnInt('foo', 'mediumint', 1));
        $this->assertEquals(Column::int('foo', 1), new ColumnInt('foo', 'int', 1));
        $this->assertEquals(Column::bigint('foo', 1), new ColumnInt('foo', 'bigint', 1));
    }
}
