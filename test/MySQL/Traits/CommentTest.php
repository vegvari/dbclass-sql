<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
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
