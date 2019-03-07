<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Drop;
use DBClass\SQL\MySQL\DropTable;

class DropTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new DropTable($name); }],
            [function ($name) { return Drop::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('foo', $obj->getName());
        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
        $this->assertSame('DROP TABLE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifNotExists();
        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
