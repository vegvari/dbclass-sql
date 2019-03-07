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
            [function ($database, $charset = null, $collation = null) { return new CreateDatabase($database, $charset, $collation); }],
            [function ($database, $charset = null, $collation = null) { return Create::database($database, $charset, $collation); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_construct(callable $obj)
    {
        $obj = $obj('foo', 'bar', 'baz');

        $this->assertSame('foo', $obj->getName());
        $this->assertSame('bar', $obj->getCharset());
        $this->assertSame('baz', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `bar` COLLATE `baz`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('foo', $obj->getName());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
        $this->assertSame('CREATE DATABASE `bar` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_exists(callable $obj)
    {
        $obj = $obj('foo');

        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->ifNotExists();
        $this->assertSame('CREATE DATABASE IF NOT EXISTS `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->ifExists();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);
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
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `bar` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->setCharset();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);
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
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `bar`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);

        $obj->setCollation();
        $this->assertSame('CREATE DATABASE `foo` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_unicode_ci`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
        $this->assertSame($obj->getBuild(), (string) $obj);
    }
}
