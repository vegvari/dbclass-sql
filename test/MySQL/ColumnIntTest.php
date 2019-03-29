<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnIntTest extends TestCase
{
    use Connection;

    public static function setUpBeforeClass(): void
    {
        self::exec(Create::database('column_test')->ifNotExists());
        self::getConnection()->exec('USE column_test');

        self::exec(Drop::table('column_int_test')->ifExists());
    }

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
        $obj = Create::table('column_int_test');
        $obj->setColumn(
            Column::int('test_digits', 1),
            Column::int('test_unsigned')->setUnsigned(),
            Column::int('test_nullable')->setNullable(),
            Column::int('test_default')->setDefault(1),
            Column::int('test_comment')->setComment('test_comment')
        );

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('column_int_test'));
    }
}
