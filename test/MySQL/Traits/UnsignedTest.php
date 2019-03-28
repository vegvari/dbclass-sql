<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Column;
use PHPUnit\Framework\TestCase;

class UnsignedTest extends TestCase
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
    public function test_unsigned(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->isUnsigned());

        $obj->setUnsigned();
        $this->assertSame(true, $obj->isUnsigned());

        $obj->setUnsigned(false);
        $this->assertSame(false, $obj->isUnsigned());
    }
}
