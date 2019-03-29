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

    public static function exec($query)
    {
        if ($query instanceof Interfaces\Statement) {
            $query = $query->getBuild();
        }

        self::getConnection()->exec($query);
    }

    public static function fetchAll($query): array
    {
        if ($query instanceof Interfaces\Statement) {
            $query = $query->getBuild();
        }

        $statement = self::getConnection()->prepare($query);
        $statement->execute([]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function showCreateDatabase(string $name): string
    {
        return self::fetchAll(Show::createDatabase($name))[0]['Create Database'];
    }

    public static function showCreateTable(string $name, ?string $database_name = null): string
    {
        return self::fetchAll(Show::createTable($name, $database_name))[0]['Create Table'];
    }
}
