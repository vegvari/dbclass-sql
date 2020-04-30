<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    use ConnectionTrait;

    public static function setUpBeforeClass(): void
    {
        self::exec(Drop::databaseIfExists('create_table_test'));
        self::exec(Create::database('create_table_test'));
        self::exec('USE create_table_test');
    }

    public function testNames()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(false, $obj->hasDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());

        $obj = new CreateTable('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame(true, $obj->hasDatabaseName());
        $this->assertSame('bar', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getTableName());
        $this->assertSame('foo', $obj->getName());

        $obj->setDatabaseName();
        $this->assertSame(false, $obj->hasDatabaseName());
    }

    public function testIfNotExists()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->setIfNotExists();
        $this->assertSame(true, $obj->getIfNotExists());

        $obj->setIfNotExists(false);
        $this->assertSame(false, $obj->getIfNotExists());
    }

    public function testCharset()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(CreateTable::DEFAULT_CHARSET, $obj->getCharset());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());

        $obj->setCharset();
        $this->assertSame(CreateTable::DEFAULT_CHARSET, $obj->getCharset());
    }

    public function testCollation()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(CreateTable::DEFAULT_COLLATION, $obj->getCollation());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());

        $obj->setCollation();
        $this->assertSame(CreateTable::DEFAULT_COLLATION, $obj->getCollation());
    }

    public function testEngine()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(CreateTable::DEFAULT_ENGINE, $obj->getEngine());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame(CreateTable::DEFAULT_ENGINE, $obj->getEngine());
    }

    public function testColumns()
    {
        $obj = new CreateTable('foo');
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

    public function testFailColumnSet()
    {
        $this->expectException(Exceptions\Table::class);
        $this-> expectExceptionMessage('Column is already set: "bar"');

        $obj = new CreateTable('foo');
        $obj->setColumn(Column::int('bar'), Column::int('bar'));
    }

    public function testFailColumnGet()
    {
        $this->expectException(Exceptions\Table::class);
        $this-> expectExceptionMessage('Column is not set: "bar"');

        $obj = new CreateTable('foo');
        $obj->getColumn('bar');
    }

    public function testComment()
    {
        $obj = new CreateTable('foo');
        $this->assertSame(false, $obj->hasComment());

        $obj->setComment('bar');
        $this->assertSame(true, $obj->hasComment());
        $this->assertSame('bar', $obj->getComment());

        $obj->setComment();
        $this->assertSame(false, $obj->hasComment());
    }

    public function testBuild()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }

    public function testBuildDatabaseName()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setDatabaseName('create_table_test');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        self::exec($obj);

        $obj->setDatabaseName();
        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }

    public function testBuildIfNotExists()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        $obj->setIfNotExists();
        self::exec($obj);

        $obj->setIfNotExists(false);
        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }

    public function testBuildCharsetCollation()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }

    public function testBuildEngine()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        $obj->setEngine('MyISAM');
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }

    public function testBuildComment()
    {
        self::exec(Drop::tableIfExists('test_build'));

        $obj = new CreateTable('test_build');
        $obj->setColumn(Column::int('foo'), Column::int('bar'), Column::int('baz'));
        $obj->setComment('test_build');
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('test_build'));
    }
}
