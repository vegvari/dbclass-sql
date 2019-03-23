<?php

namespace DBClass\SQL\MySQL;

class DropDatabaseBuilderTest extends DropDatabaseTest
{
    /**
     * @dataProvider getImplementations
     */
    public function test_name(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('DROP DATABASE `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_if_exists(callable $obj)
    {
        $obj = $obj('foo');
        $obj->setIfExists(true);
        $this->assertSame('DROP DATABASE IF EXISTS `foo`;', $obj->getBuild());
        $this->assertSame([], $obj->getData());
    }
}
