<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Drop::database($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP DATABASE `foo`', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setIfExists(true);
        $this->assertSame('DROP DATABASE IF EXISTS `foo`', $obj->getBuild());

        $obj = $obj('foo');
        $obj->ifExists();
        $this->assertSame('DROP DATABASE IF EXISTS `foo`', $obj->getBuild());
    }
}
