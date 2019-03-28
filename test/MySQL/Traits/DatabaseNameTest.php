<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class DatabaseNameTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
            [function ($name) { return new Fixtures\DropTableFixture($name); }],
            [function ($name) { return new Fixtures\IntColumnFixture($name, 'int'); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(null, $obj->getDatabaseName());

        $obj->setDatabaseName('bar');
        $this->assertSame('bar', $obj->getDatabaseName());
    }
}
