<?php

namespace DBClass\SQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Create as MySQLCreate;
use DBClass\SQL\MySQL\CreateDatabase as MySQLCreateDatabase;

/**
 * @covers DBClass\SQL\MySQL\CreateDatabase
 * @covers DBClass\SQL\MySQL\Create::Database
 */
class CreateDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($database) { return new MySQLCreateDatabase($database); }],
            [function ($database) { return MySQLCreate::database($database); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_database(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('foo', $obj->getDatabase());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());

        $obj->setDatabase('bar');
        $this->assertSame('bar', $obj->getDatabase());
        $this->assertSame('CREATE DATABASE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4', $obj->getCharset());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->build());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->build());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());

        $obj->ifNotExists();
        $this->assertSame('CREATE DATABASE IF NOT EXISTS `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());

        $obj->ifExists();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->build());
    }
}
