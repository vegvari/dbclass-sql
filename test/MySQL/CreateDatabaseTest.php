<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateDatabaseTest extends TestCase
{
    use Connection;

    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::database($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build(callable $obj)
    {
        $obj = $obj('foo');

        self::exec(Drop::database('foo')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->getBuild(), self::showCreateDatabase('foo'));
        self::exec(Drop::database('foo'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifNotExists();

        self::exec(Drop::database('foo')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->setIfNotExists(false)->getBuild(), self::showCreateDatabase('foo'));
        self::exec(Drop::database('foo'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_charset_collation(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');

        self::exec(Drop::database('foo')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->getBuild(), self::showCreateDatabase('foo'));
        self::exec(Drop::database('foo'));
    }
}
