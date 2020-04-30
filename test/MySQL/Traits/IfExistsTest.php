<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Drop;
use PHPUnit\Framework\TestCase;

class IfExistsTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Drop::database($name); }],
            [function ($name) { return Drop::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->getIfExists());

        $obj->ifExists();
        $this->assertSame(true, $obj->getIfExists());
    }
}
