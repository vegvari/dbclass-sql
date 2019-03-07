<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Drop;
use DBClass\SQL\MySQL\DropDatabase;

class DropDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new DropDatabase($name); }],
            [function ($name) { return Drop::database($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('foo', $obj->getName());
        $this->assertSame('DROP DATABASE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
        $this->assertSame('DROP DATABASE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('DROP DATABASE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifExists();
        $this->assertSame('DROP DATABASE IF EXISTS `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifNotExists();
        $this->assertSame('DROP DATABASE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
