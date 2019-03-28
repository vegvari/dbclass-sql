<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableBuilderTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\DropTableFixture($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame('DROP TABLE `bar`.`foo`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`;', $obj->getBuild());
    }
}
