<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableFixture extends DropTable implements Interfaces\DropTable
{
}

class DropTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new DropTableFixture($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('foo', $obj->getName());

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
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
