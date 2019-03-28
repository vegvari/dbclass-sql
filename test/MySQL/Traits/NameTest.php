<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateDatabaseFixture($name); }],
            [function ($name) { return new Fixtures\DropDatabaseFixture($name); }],
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
            [function ($name) { return new Fixtures\DropTableFixture($name); }],
            [function ($name) { return new Fixtures\ColumnIntFixture($name, 'int'); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('foo', $obj->getName());

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
    }
}
