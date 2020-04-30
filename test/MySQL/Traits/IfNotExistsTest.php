<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class IfNotExistsTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::database($name); }],
            [function ($name) { return Create::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->setIfNotExists(true);
        $this->assertSame(true, $obj->getIfNotExists());

        $obj->setIfNotExists(false);
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->ifNotExists();
        $this->assertSame(true, $obj->getIfNotExists());
    }
}
