<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Drop;
use DBClass\MySQL\Column;
use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::database($name); }],
            [function ($name) { return Create::table($name); }],

            [function ($name) { return Drop::database($name); }],
            [function ($name) { return Drop::table($name); }],

            [function ($name) { return Column::int($name); }],
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
