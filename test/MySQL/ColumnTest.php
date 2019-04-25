<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnTestFixture extends Column
{
    public function isTypeValid(string $type): bool
    {
        return $type === 'foo';
    }

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
        $obj->setType('foo');

        $this->assertSame('foo', $obj->getType());
    }

    public function test_type_fail()
    {
        $this->expectException(Exceptions\Column::class);
        $this-> expectExceptionMessage('Invalid column type: "bar"');

        $obj = new ColumnTestFixture();
        $obj->setType('bar');
    }

    public function test_auto_increment()
    {
        $obj = new ColumnTestFixture();
        $this->assertSame(false, $obj->isAutoIncrement());
    }
}
