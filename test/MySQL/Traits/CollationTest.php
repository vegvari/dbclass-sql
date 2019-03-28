<?php

namespace DBClass\MySQL\Traits;

use DBClass\MySQL\Create;
use PHPUnit\Framework\TestCase;

class CollationTest extends TestCase
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
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());

        $obj->setCollation();
        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());
    }
}
