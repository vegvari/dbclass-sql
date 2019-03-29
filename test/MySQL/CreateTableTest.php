<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    use ConnectionTrait;

    public static function setUpBeforeClass(): void
    {
        self::exec(Drop::database('create_table_test')->ifExists());
        self::exec(Create::database('create_table_test'));
        self::exec('USE create_table_test');
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
    public function test_column(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame([], $obj->getColumns());
        $this->assertSame(false, $obj->hasColumn('bar'));

        $bar = Column::int('bar');
        $baz = Column::int('baz');
        $obj->setColumn($bar, $baz);
        $this->assertSame(['bar' => $bar, 'baz' => $baz], $obj->getColumns());
        $this->assertSame(['baz' => $baz], $obj->getColumns('baz'));
        $this->assertSame(['baz' => $baz, 'bar' => $bar], $obj->getColumns('baz', 'bar'));
        $this->assertSame(true, $obj->hasColumn('bar'));
        $this->assertSame(true, $obj->hasColumn('baz'));
        $this->assertSame(false, $obj->hasColumn('foobar'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_fail_get_column(callable $obj)
    {
        $this->expectException(Exceptions\Table::class);
        $this-> expectExceptionMessage('Column is not set: "bar"');

        $obj = $obj('foo');
        $this->assertSame([], $obj->getColumn('bar'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_fail_get_columns(callable $obj)
    {
        $this->expectException(Exceptions\Table::class);
        $this-> expectExceptionMessage('Column is not set: "bar"');

        $obj = $obj('foo');
        $this->assertSame([], $obj->getColumns('bar'));
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
