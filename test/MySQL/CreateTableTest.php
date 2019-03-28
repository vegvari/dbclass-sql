<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;

class CreateTableTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name, $database_name = null) { return new Fixtures\CreateTableFixture($name, $database_name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_engine(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame('InnoDB', $obj->getEngine());

        $obj->setEngine('bar');
        $this->assertSame('bar', $obj->getEngine());

        $obj->setEngine();
        $this->assertSame('InnoDB', $obj->getEngine());
    }
}
