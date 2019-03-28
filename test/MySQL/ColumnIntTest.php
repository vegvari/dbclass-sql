<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnIntTest extends TestCase
{
    public function test_digits()
    {
        $obj = new Fixtures\ColumnIntFixture('foo', 'int', 1);
        $this->assertSame(1, $obj->getDigits());

        $obj->setDigits(2);
        $this->assertSame(2, $obj->getDigits());

        $obj->setDigits();
        $this->assertSame(Fixtures\ColumnIntFixture::DIGITS['int'], $obj->getDigits());

        $obj->setUnsigned();
        $this->assertSame(Fixtures\ColumnIntFixture::DIGITS['int'] - 1, $obj->getDigits());

        $obj->setType('bigint');
        $this->assertSame(Fixtures\ColumnIntFixture::DIGITS['bigint'], $obj->getDigits());
    }
}
