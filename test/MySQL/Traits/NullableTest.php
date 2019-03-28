<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Column;
use PHPUnit\Framework\TestCase;

class NullableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Column::int($name); }],
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
