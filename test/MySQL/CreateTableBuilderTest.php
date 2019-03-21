<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Create;
use DBClass\SQL\MySQL\CreateTable;

class CreateTableBuilderTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new CreateTable($name); }],
            [function ($name) { return Create::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifNotExists();
        $this->assertSame('CREATE TABLE IF NOT EXISTS `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setEngine('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCharset('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCollation('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_comment(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setComment('bar');
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci` COMMENT \'bar\';', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
