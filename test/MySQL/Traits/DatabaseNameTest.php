<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Drop;
use DBClass\MySQL\Column;
use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class DatabaseNameTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::table($name); }],
            [function ($name) { return Drop::table($name); }],
            [function ($name) { return Column::char($name, 255); }],
            [function ($name) { return Column::datetime($name); }],
            [function ($name) { return Column::int($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(null, $obj->getDatabaseName());
        $this->assertSame(false, $obj->hasDatabaseName());

        $obj->setDatabaseName('bar');
        $this->assertSame('bar', $obj->getDatabaseName());
        $this->assertSame(true, $obj->hasDatabaseName());
    }
}
