<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Column;
use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::table($name); }],
            [function ($name) { return Column::char($name, 255); }],
            [function ($name) { return Column::datetime($name); }],
            [function ($name) { return Column::int($name); }],
        ];
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
