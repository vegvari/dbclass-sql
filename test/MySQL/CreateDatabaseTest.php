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
        $obj = $obj('test_build');

        self::exec(Drop::database('test_build')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->getBuild(), self::showCreateDatabase('test_build'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_if_not_exists(callable $obj)
    {
        $obj = $obj('test_build_if_not_exists');
        $obj->ifNotExists();

        self::exec(Drop::database('test_build_if_not_exists')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->setIfNotExists(false)->getBuild(), self::showCreateDatabase('test_build_if_not_exists'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_build_charset_collation(callable $obj)
    {
        $obj = $obj('test_build_charset_collation');
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');

        self::exec(Drop::database('test_build_charset_collation')->ifExists());
        self::exec($obj);
        $this->assertSame($obj->getBuild(), self::showCreateDatabase('test_build_charset_collation'));
    }
}
