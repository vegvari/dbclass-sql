<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class DropTableTest extends TestCase
{
    public function testBuild()
    {
        $obj = Drop::table('foo');
        $this->assertSame('DROP TABLE `foo`', $obj->getBuild());

        $obj = Drop::table('foo', 'bar');
        $this->assertSame('DROP TABLE `bar.foo`', $obj->getBuild());

        $obj = Drop::tableIfExists('foo');
        $this->assertSame('DROP TABLE IF EXISTS `foo`', $obj->getBuild());

        $obj = Drop::tableIfExists('foo', 'bar');
        $this->assertSame('DROP TABLE IF EXISTS `bar.foo`', $obj->getBuild());
    }
}
