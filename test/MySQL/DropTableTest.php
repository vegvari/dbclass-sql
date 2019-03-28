<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Drop::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE `bar`.`foo`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`;', $obj->getBuild());
    }
}
