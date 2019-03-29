<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Show::createDatabase($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('SHOW CREATE DATABASE `foo`', $obj->getBuild());
    }
}
