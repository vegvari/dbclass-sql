<?php

namespace DBClass\MySQL;

use PHPUnit\Framework\TestCase;

class CreateDatabaseTest extends TestCase
{
    use ConnectionTrait;

    public function testNames()
    {
        $obj = new CreateDatabase('foo');
        $this->assertSame('foo', $obj->getDatabaseName());
        $this->assertSame('foo', $obj->getName());
    }

    public function testCharset()
    {
        $obj = new CreateDatabase('foo');
        $this->assertSame(CreateDatabase::DEFAULT_CHARSET, $obj->getCharset());

        $obj->setCharset('bar');
        $this->assertSame('bar', $obj->getCharset());

        $obj->setCharset();
        $this->assertSame(CreateDatabase::DEFAULT_CHARSET, $obj->getCharset());
    }

    public function testCollation()
    {
        $obj = new CreateDatabase('foo');
        $this->assertSame(CreateDatabase::DEFAULT_COLLATION, $obj->getCollation());

        $obj->setCollation('bar');
        $this->assertSame('bar', $obj->getCollation());

        $obj->setCollation();
        $this->assertSame(CreateDatabase::DEFAULT_COLLATION, $obj->getCollation());
    }

    public function testBuild()
    {
        self::exec(Drop::databaseIfExists('test_build'));

        $obj = new CreateDatabase('test_build');
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateDatabase('test_build'));
    }

    public function testBuildCharsetCollation()
    {
        self::exec(Drop::databaseIfExists('test_build'));

        $obj = new CreateDatabase('test_build');
        $obj->setCharset('latin1');
        $obj->setCollation('latin1_bin');
        self::exec($obj);

        $this->assertSame($obj->getBuild(), self::showCreateDatabase('test_build'));
    }

    public function testBuildIfNotExists()
    {
        self::exec(Drop::databaseIfExists('test_build'));

        $obj = new CreateDatabase('test_build');
        $obj->setIfNotExists();
        self::exec($obj);

        $obj->setIfNotExists(false);
        $this->assertSame($obj->getBuild(), self::showCreateDatabase('test_build'));
    }
}
