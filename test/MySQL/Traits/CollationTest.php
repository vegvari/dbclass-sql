<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class CollationTest extends TestCase
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
