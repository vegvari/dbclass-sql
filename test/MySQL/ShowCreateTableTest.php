<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name, $database_name = null) { return Show::createTable($name, $database_name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('SHOW CREATE TABLE `foo`', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_database_name(callable $obj)
    {
        $obj = $obj('foo', 'bar');
        $this->assertSame('SHOW CREATE TABLE `bar`.`foo`', $obj->getBuild());
    }
}
