<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnIntTest extends TestCase
{
    public function test_digits()
    {
        $obj = Column::int('foo', 1);
        $this->assertSame(1, $obj->getDigits());

        $obj->setDigits(2);
        $this->assertSame(2, $obj->getDigits());

        $obj->setDigits();
        $this->assertSame(ColumnInt::DIGITS['int'], $obj->getDigits());

        $obj->setUnsigned();
        $this->assertSame(ColumnInt::DIGITS['int'] - 1, $obj->getDigits());

        $obj->setType('bigint');
        $this->assertSame(ColumnInt::DIGITS['bigint'], $obj->getDigits());
    }

    public function test_auto_increment()
    {
        $obj = Column::int('foo', 1);
        $this->assertSame(false, $obj->isAutoIncrement());

        $obj->setAutoIncrement();
        $this->assertSame(true, $obj->isAutoIncrement());

        $obj->setAutoIncrement(false);
        $this->assertSame(false, $obj->isAutoIncrement());
    }

    public function test_default()
    {
        $obj = Column::int('foo', 1);
        $this->assertSame(false, $obj->hasDefault());

        $obj->setDefault(1);
        $this->assertSame(true, $obj->hasDefault());
        $this->assertSame(1, $obj->getDefault());

        $obj->setDefault();
        $this->assertSame(false, $obj->hasDefault());
    }

    public function test_build()
    {
        $obj = Column::int('foo', 1);
        $this->assertSame('`foo` INT(1) NOT NULL DEFAULT NULL', $obj->getBuild());

        $obj = Column::int('foo', 1);
        $obj->setUnsigned();
        $this->assertSame('`foo` INT(1) UNSIGNED NOT NULL DEFAULT NULL', $obj->getBuild());

        $obj = Column::int('foo', 1);
        $obj->setNullable();
        $this->assertSame('`foo` INT(1) NULL DEFAULT NULL', $obj->getBuild());

        $obj = Column::int('foo', 1);
        $obj->setDefault(1);
        $this->assertSame('`foo` INT(1) NOT NULL DEFAULT "1"', $obj->getBuild());

        $obj = Column::int('foo', 1);
        $obj->setAutoIncrement();
        $this->assertSame('`foo` INT(1) NOT NULL DEFAULT NULL AUTO_INCREMENT', $obj->getBuild());

        $obj = Column::int('foo', 1);
        $obj->setComment('bar');
        $this->assertSame('`foo` INT(1) NOT NULL DEFAULT NULL COMMENT "bar"', $obj->getBuild());
    }
}
