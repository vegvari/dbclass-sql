<?php

namespace DBClass\SQL\MySQL\Traits;

use DBClass\SQL\MySQL\Fixtures;
use PHPUnit\Framework\TestCase;

class IfNotExistsTest extends TestCase
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
