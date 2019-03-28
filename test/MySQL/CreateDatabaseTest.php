<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateDatabaseTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::database($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());

        $obj->setName('bar');
        $this->assertSame('CREATE DATABASE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());

        $obj->setIfNotExists(true);
        $this->assertSame('CREATE DATABASE IF NOT EXISTS `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());

        $obj->setCharset('bar');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());

        $obj->setCollation('bar');
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
    }
}
