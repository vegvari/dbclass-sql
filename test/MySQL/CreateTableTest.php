<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Create;
use DBClass\SQL\MySQL\CreateTable;

class CreateTableTest extends TestCase
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

        $this->assertSame('foo', $obj->getName());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
        $this->assertSame('CREATE TABLE `bar` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame(false, $obj->getIfNotExists());

        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setIfNotExists(true);
        $this->assertSame(true, $obj->getIfNotExists());
        $obj->ifNotExists();
        $this->assertSame('CREATE TABLE IF NOT EXISTS `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setIfNotExists(false);
        $this->assertSame(false, $obj->getIfNotExists());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifNotExists();
        $this->assertSame(true, $obj->getIfNotExists());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('InnoDB', $obj->getEngine());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());
        $this->assertSame('CREATE TABLE `foo` ENGINE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setEngine();
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4', $obj->getCharset());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCharset();
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCollation();
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_comment(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame(null, $obj->getComment());
        $this->assertSame(false, $obj->hasComment());

        $obj->setComment('bar');
        $this->assertSame('bar', $obj->getComment());
        $this->assertSame(true, $obj->hasComment());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci` COMMENT \'bar\';', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setComment();
        $this->assertSame(null, $obj->getComment());
        $this->assertSame(false, $obj->hasComment());
        $this->assertSame('CREATE TABLE `foo` ENGINE `InnoDB` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
