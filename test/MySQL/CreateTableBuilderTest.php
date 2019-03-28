<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableBuilderTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name, $database_name = null) { return new Fixtures\CreateTableFixture($name, $database_name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database_name(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setDatabaseName('bar');
        $this->assertSame('CREATE TABLE `bar`.`foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifNotExists();
        $this->assertSame('CREATE TABLE IF NOT EXISTS `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setEngine('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCharset('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCollation('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_comment(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setComment('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci` COMMENT \'bar\';', $obj->getBuild());
    }
}
