<?php

namespace DBClass\MySQL;

use PDO;

trait Connection
{
    private static $pdo;

    public function getHost(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return '127.0.0.1';
        }

        return 'homestead';
    }

    public function getUser(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return 'root';
        }

        return 'homestead';
    }

    public function getPassword(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return '';
        }

        return 'secret';
    }

    public function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $options = [
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_ORACLE_NULLS       => PDO::NULL_EMPTY_STRING,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            ];

            self::$pdo = new PDO(sprintf('mysql:host=%s', $this->getHost()), $this->getUser(), $this->getPassword(), $options);
        }

        return self::$pdo;
    }

    public function exec(Interfaces\Statement $query): array
    {
        $statement = $this->getConnection()->prepare($query->getBuild());
        $statement->execute([]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showCreateDatabase(string $name): string
    {
        return $this->exec(Show::createDatabase('foo'))[0]['Create Database'];
    }
}
