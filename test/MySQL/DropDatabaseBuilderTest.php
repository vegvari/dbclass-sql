<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;

class DropDatabaseBuilderTest extends TestCase
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
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP DATABASE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setIfExists(true);
        $this->assertSame('DROP DATABASE IF EXISTS `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
