<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    use Connection;

    public static function setUpBeforeClass()
    {
        self::exec(Drop::database('create_table_test')->ifExists());
        self::exec(Create::database('create_table_test'));
        self::getConnection()->exec('USE create_table_test');
    }

    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('InnoDB', $obj->getEngine());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame('InnoDB', $obj->getEngine());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_name(callable $obj)
    {
        $obj = $obj('test_build_name');
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_name'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_database_name(callable $obj)
    {
        $obj = $obj('test_build_database_name');
        $obj->setDatabaseName('create_table_test');
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $obj->setDatabaseName();
        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_database_name'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_if_not_exists(callable $obj)
    {
        $obj = $obj('test_build_if_not_exists');
        $obj->ifNotExists();
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $obj->setIfNotExists(false);
        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_if_not_exists'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_engine(callable $obj)
    {
        $obj = $obj('test_build_engine');
        $obj->setEngine('MyISAM');
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_engine'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_charset_collation(callable $obj)
    {
        $obj = $obj('test_build_charset_collation');
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_charset_collation'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_comment(callable $obj)
    {
        $obj = $obj('test_build_comment');
        $obj->setComment('test_build_comment');
        $obj->setColumn(Column::int('foo'));

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build_comment'));
    }
}
