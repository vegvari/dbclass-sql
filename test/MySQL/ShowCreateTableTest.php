<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ShowCreateTableTest extends TestCase
{
    use ConnectionTrait;

    public static function setUpBeforeClass(): void
    {
        self::exec(Drop::database('show_create_table_test')->ifExists());
        self::exec(Create::database('show_create_table_test'));
        self::exec('USE show_create_table_test');

        $table = Create::table('foo');
        $table->setColumn(Column::int('foo'));
        self::exec($table);
    }

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
        self::fetchAll($obj);
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_database_name(callable $obj)
    {
        $obj = $obj('foo', 'show_create_table_test');
        $this->assertSame('SHOW CREATE TABLE `show_create_table_test`.`foo`', $obj->getBuild());
        self::fetchAll($obj);
    }
}
