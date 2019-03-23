<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class CharsetTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateDatabaseFixture($name); }],
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
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
