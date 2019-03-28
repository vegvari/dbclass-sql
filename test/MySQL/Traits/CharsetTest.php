<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class CharsetTest extends TestCase
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
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('utf8mb4', $obj->getCharset());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());

        $obj->setCharset();
        $this->assertSame('utf8mb4', $obj->getCharset());
    }
}
