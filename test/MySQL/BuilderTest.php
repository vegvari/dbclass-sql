<?php

namespace DBClass\SQL\MySQL;

use PHPUnit\Framework\TestCase;
use DBClass\SQL\MySQL\Drop;
use DBClass\SQL\MySQL\Create;

class BuilderFixture implements Interfaces\Builder
{
    public function getBuild(Interfaces\Statement $statement): string
    {
        return '';
    }
}

class BuilderTest extends TestCase
{
    public function getImplementations(): array
    {
        return [
            [function ($name) { return Create::database($name); }],
            [function ($name) { return Create::table($name); }],
            [function ($name) { return Drop::database($name); }],
            [function ($name) { return Drop::table($name); }],
        ];
    }

    /**
     * @dataProvider getImplementations
     */
    public function test_builder(callable $obj)
    {
        $obj = $obj('foo');
        $this->assertSame(false, $obj->hasBuilder());

        $builder = new BuilderFixture();
        $obj->setBuilder($builder);
        $this->assertSame(true, $obj->hasBuilder());
        $this->assertSame($builder, $obj->getBuilder());
    }
}
