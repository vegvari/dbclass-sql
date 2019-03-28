<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
            [function ($name) { return new Fixtures\ColumnIntFixture($name, 'int'); }],
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
