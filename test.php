<?php

class CreateDatabase extends Create
{
	private $database;
	private $charset = 'utf8';
	private $collation = 'utf8_general_ci';
	private $if_not_exists = false;

	public function __construct(string $database)
	{
		$this->setDatabase($database);
	}

	public function setDatabase(string $database): self
	{
		$this->database = $database;
		return $this;
	}

	public function getDatabase(): string
	{
		return $this->database;
	}

	public function setCharset(string $charset): self
	{
		$this->charset = $charset;
		return $this;
	}

	public function getCharset(): string
	{
		return $this->charset;
	}

	public function setCollation(string $collation): self
	{
		$this->collation = $collation;
		return $this;
	}

	public function getCollation(): string
	{
		return $this->collation;
	}

	public function ifNotExists(): self
	{
		$this->if_not_exists = true;
		return $this;
	}

	public function getStatement(): string
	{
		$build[] = 'CREATE DATABASE';

		if ($this->if_not_exists === true) {
			$build[] = 'IF NOT EXISTS';
		}

		$build[] = sprintf('`%s`', $this->getDatabase());
		$build[] = sprintf('CHARACTER SET `%s`', $this->getCharset());
		$build[] = sprintf('COLLATE `%s`', $this->getCollation());

		return implode(' ', $build) . ';';
	}
}



$s = Create::database('foo');


var_dump($s->getStatement());

















