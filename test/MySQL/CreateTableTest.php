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
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('InnoDB', $obj->getEngine());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame('InnoDB', $obj->getEngine());
    }
}
