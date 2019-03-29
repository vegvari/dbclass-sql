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

    public function test_show()
    {
        $this->assertEquals(Show::createDatabase('foo'), new ShowCreateDatabase('foo'));
        $this->assertEquals(Show::createTable('foo'), new ShowCreateTable('foo'));
        $this->assertEquals(Show::createTable('foo', 'bar'), new ShowCreateTable('foo', 'bar'));
    }

    public function test_int_column()
    {
        $this->assertEquals(Column::tinyint('foo', 1), new ColumnInt('foo', 'tinyint', 1));
        $this->assertEquals(Column::smallint('foo', 1), new ColumnInt('foo', 'smallint', 1));
        $this->assertEquals(Column::mediumint('foo', 1), new ColumnInt('foo', 'mediumint', 1));
        $this->assertEquals(Column::int('foo', 1), new ColumnInt('foo', 'int', 1));
        $this->assertEquals(Column::bigint('foo', 1), new ColumnInt('foo', 'bigint', 1));
    }

    public function test_datetime_column()
    {
        $a = Column::datetime('foo');
        $b = new ColumnDateTime('foo');
        $this->assertEquals($a, $b);

        $a = Column::createdAt();
        $b = new ColumnDateTime('created_at');
        $b->setDefaultCurrent();
        $this->assertEquals($a, $b);

        $a = Column::createdAt('foo');
        $b = new ColumnDateTime('foo');
        $b->setDefaultCurrent();
        $this->assertEquals($a, $b);

        $a = Column::updatedAt();
        $b = new ColumnDateTime('updated_at');
        $b->setDefaultCurrent();
        $b->setOnUpdateCurrent();
        $this->assertEquals($a, $b);

        $a = Column::updatedAt('foo');
        $b = new ColumnDateTime('foo');
        $b->setDefaultCurrent();
        $b->setOnUpdateCurrent();
        $this->assertEquals($a, $b);

        $a = Column::deletedAt();
        $b = new ColumnDateTime('deleted_at');
        $b->setNullable();
        $this->assertEquals($a, $b);

        $a = Column::deletedAt('foo');
        $b = new ColumnDateTime('foo');
        $b->setNullable();
        $this->assertEquals($a, $b);
    }
}
