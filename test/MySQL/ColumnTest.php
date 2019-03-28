<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnTestFixture extends Column
{
    public function getBuild(): string
    {
        return '';
    }
}

class ColumnTest extends TestCase
{
    public function test_type()
    {
        $obj = new ColumnTestFixture();
        $obj->setType('int');

        $this->assertSame('int', $obj->getType());
    }

    public function test_type_fail()
    {
        $this->expectException(Exceptions\Column::class);
        $this-> expectExceptionMessage('Invalid column type: "foo"');

        $obj = new ColumnTestFixture();
        $obj->setType('foo');
    }
}
