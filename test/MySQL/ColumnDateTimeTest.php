<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class ColumnDateTimeTest extends TestCase
{
    use ConnectionTrait;

    public static function setUpBeforeClass(): void
    {
        self::exec(Create::database('column_test')->ifNotExists());
        self::getConnection()->exec('USE column_test');

        self::exec(Drop::table('column_datetime_test')->ifExists());
    }

    public function test_default()
    {
        $obj = Column::datetime('foo');
        $this->assertSame(false, $obj->hasDefault());
        $this->assertSame(false, $obj->isDefaultCurrent());

        $obj->setDefault('2001-02-03 04:05:06');
        $this->assertSame('2001-02-03 04:05:06', $obj->getDefault());
        $this->assertSame(true, $obj->hasDefault());
        $this->assertSame(false, $obj->isDefaultCurrent());

        $obj->setDefaultCurrent();
        $this->assertSame('CURRENT_TIMESTAMP', $obj->getDefault());
        $this->assertSame(true, $obj->hasDefault());
        $this->assertSame(true, $obj->isDefaultCurrent());

        $obj->setDefault();
        $this->assertSame(false, $obj->hasDefault());
        $this->assertSame(false, $obj->isDefaultCurrent());

        $obj->setDefault('CURRENT_TIMESTAMP');
        $this->assertSame('CURRENT_TIMESTAMP', $obj->getDefault());
        $this->assertSame(true, $obj->hasDefault());
        $this->assertSame(true, $obj->isDefaultCurrent());
    }

    public function test_build()
    {
        $obj = Create::table('column_datetime_test');
        $obj->setColumn(
            Column::datetime('test_nullable')->setNullable(),
            Column::datetime('test_default')->setDefault('2001-02-03 04:05:06'),
            Column::datetime('test_current_timestamp')->setDefaultCurrent(),
            Column::datetime('test_on_update_current')->setNullable()->setOnUpdateCurrent(),
            Column::datetime('test_current_timestamp_on_update_current')->setDefaultCurrent()->setOnUpdateCurrent(),
            Column::datetime('test_comment')->setNullable()->setComment('test_comment')
        );

        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateTable('column_datetime_test'));
    }
}
