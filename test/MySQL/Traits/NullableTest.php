<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class NullableTest extends TestCase
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
    public function test_nullable(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->isNullable());

        $obj->setNullable();
        $this->assertSame(true, $obj->isNullable());

        $obj->setNullable(false);
        $this->assertSame(false, $obj->isNullable());
    }
}
