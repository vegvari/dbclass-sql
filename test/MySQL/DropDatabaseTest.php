<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;

class DropDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\DropDatabaseFixture($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->getIfExists());

        $obj->setIfExists(true);
        $this->assertSame(true, $obj->getIfExists());

        $obj->setIfExists(false);
        $this->assertSame(false, $obj->getIfExists());

        $obj->ifExists();
        $this->assertSame(true, $obj->getIfExists());
    }
}
