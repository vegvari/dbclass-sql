<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class TableNameTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\ColumnIntFixture($name, 'int'); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_table_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(null, $obj->getTableName());
        $this->assertSame(false, $obj->hasTableName());

        $obj->setTableName('bar');
        $this->assertSame('bar', $obj->getTableName());
        $this->assertSame(true, $obj->hasTableName());
    }
}
