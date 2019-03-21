<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Drop;
use DBClass\SQL\MySQL\DropTable;

class DropTableBuilderTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return new DropTable($name); }],
            [function ($name) { return Drop::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP TABLE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->ifExists();
        $this->assertSame('DROP TABLE IF EXISTS `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
