<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name, $database_name = null) { return new Fixtures\CreateTableFixture($name, $database_name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database_name(callable $obj)
    {
        $obj1 = $obj('foo');
        $this->assertSame(null, $obj1->getDatabaseName());
        $this->assertSame(false, $obj1->hasDatabaseName());

        $obj1->setDatabaseName('bar');
        $this->assertSame('bar', $obj1->getDatabaseName());
        $this->assertSame(true, $obj1->hasDatabaseName());

        $obj2 = $obj('foo', 'bar');
        $this->assertSame('bar', $obj2->getDatabaseName());
        $this->assertSame(true, $obj2->hasDatabaseName());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->setIfNotExists(true);
        $this->assertSame(true, $obj->getIfNotExists());

        $obj->setIfNotExists(false);
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->ifNotExists();
        $this->assertSame(true, $obj->getIfNotExists());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('InnoDB', $obj->getEngine());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame('InnoDB', $obj->getEngine());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_comment(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(null, $obj->getComment());
        $this->assertSame(false, $obj->hasComment());

        $obj->setComment('bar');
        $this->assertSame('bar', $obj->getComment());
        $this->assertSame(true, $obj->hasComment());

        $obj->setComment();
        $this->assertSame(null, $obj->getComment());
        $this->assertSame(false, $obj->hasComment());
    }
}
