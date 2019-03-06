<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Create;
use DBClass\SQL\MySQL\CreateDatabase;

class CreateDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($database) { return new CreateDatabase($database); }],
            [function ($database) { return Create::database($database); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('foo', $obj->getDatabase());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setDatabase('bar');
        $this->assertSame('bar', $obj->getDatabase());
        $this->assertSame('CREATE DATABASE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4', $obj->getCharset());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCharset();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->setCollation();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifNotExists();
        $this->assertSame('CREATE DATABASE IF NOT EXISTS `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());

        $obj->ifExists();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
