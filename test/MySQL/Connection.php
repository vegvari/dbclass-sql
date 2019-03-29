<?php

namespace DBClass\MySQL;

use PDO;

trait Connection
{
    private static $pdo;

    public static function getHost(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return '127.0.0.1';
        }

        return 'homestead';
    }

    public static function getUser(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return 'root';
        }

        return 'homestead';
    }

    public static function getPassword(): string
    {
        if (isset($_SERVER['TRAVIS'])) {
            return '';
        }

        return 'secret';
    }

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $options = [
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_ORACLE_NULLS       => PDO::NULL_EMPTY_STRING,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            ];

            self::$pdo = new PDO(sprintf('mysql:host=%s', self::getHost()), self::getUser(), self::getPassword(), $options);
        }

        return self::$pdo;
    }

    public static function execute(string $query, array $data = []): array
    {
        $statement = self::getConnection()->prepare($query);
        $statement->execute($data);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function exec(Interfaces\Statement $query): array
    {
        return self::execute($query->getBuild(), []);
    }

    public static function showCreateDatabase(string $name): string
    {
        return self::exec(Show::createDatabase($name))[0]['Create Database'];
    }

    public static function showCreateTable(string $name, ?string $database_name = null): string
    {
        return self::exec(Show::createTable($name, $database_name))[0]['Create Table'];
    }
}
