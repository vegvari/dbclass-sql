<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new Fixtures\CreateTableFixture($name); }],
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
        $obj = $obj('foo');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame('CREATE TABLE `bar`.`foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifNotExists();
        $this->assertSame('CREATE TABLE IF NOT EXISTS `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_engine(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setEngine('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_charset(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCharset('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_collation(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCollation('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_comment(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setComment('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci` COMMENT \'bar\';', $obj->getBuild());
    }
}
