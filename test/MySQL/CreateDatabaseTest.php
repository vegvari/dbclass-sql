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
    public function test(callable $obj)
    {
        $obj = $obj('foo');

        $this->exec(Drop::database('foo')->ifExists());
        $this->exec($obj);
        $this->assertSame($obj->getBuild(), $this->showCreateDatabase('foo'));
        $this->exec(Drop::database('foo'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_not_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifNotExists();

        $this->exec(Drop::database('foo')->ifExists());
        $this->exec($obj);
        $this->assertSame($obj->setIfNotExists(false)->getBuild(), $this->showCreateDatabase('foo'));
        $this->exec(Drop::database('foo'));
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_charset_collation(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');

        $this->exec(Drop::database('foo')->ifExists());
        $this->exec($obj);
        $this->assertSame($obj->getBuild(), $this->showCreateDatabase('foo'));
        $this->exec(Drop::database('foo'));
    }
}
