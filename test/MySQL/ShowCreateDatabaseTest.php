<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateDatabaseTest extends TestCase
{
    use Connection;

    public static function setUpBeforeClass(): void
    {
        self::exec(Drop::database('show_create_database_test')->ifExists());
        self::exec(Create::database('show_create_database_test'));
    }

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
        $obj = $obj('show_create_database_test');
        $this->assertSame('SHOW CREATE DATABASE `show_create_database_test`', $obj->getBuild());
        self::fetchAll($obj);
    }
}
