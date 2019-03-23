<?php

namespace DBClass\SQL\MySQL;

class DropTableBuilderTest extends DropTableTest
{
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
