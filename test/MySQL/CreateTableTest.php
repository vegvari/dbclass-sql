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

        $obj->setName('bar');
        $this->assertSame('bar', $obj->getName());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->getIfNotExists());

        $obj->setIfNotExists(true);
        $this->assertSame(true, $obj->getIfNotExists());

        $obj->setIfNotExists(false);
        $this->assertSame(false, $obj->getIfNotExists());

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

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame('InnoDB', $obj->getEngine());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('utf8mb4', $obj->getCharset());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());

        $obj->setCharset();
        $this->assertSame('utf8mb4', $obj->getCharset());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_collation(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());

        $obj->setCollation();
        $this->assertSame('utf8mb4_unicode_ci', $obj->getCollation());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_comment(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->hasComment());

        $obj->setComment('bar');
        $this->assertSame(true, $obj->hasComment());
        $this->assertSame('bar', $obj->getComment());

        $obj->setComment();
        $this->assertSame(false, $obj->hasComment());
    }
}
