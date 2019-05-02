<?php

namespace Kernel;

class Database
{
    private static $instance = null;

    private const HOST = 'localhost';
    private const DB_NAME = 'blogify';
    private const USERNAME = 'root';
    private const PASSWORD = '';

    public function __construct(){}
    public function __clone(){}

    public static function getInstance(?string $host = null, ?string $dbName = null, ?string $username = null, ?string $password = null): ?\PDO {
        if (!isset(self::$instance)) {
            $host = $host ?? self::HOST;
            $dbName = $dbName ?? self::DB_NAME;
            $username = $username ?? self::USERNAME;
            $password = $password ?? self::PASSWORD;

            $pdoOptions[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
            try {
                self::$instance = new \PDO(
                    'mysql:host='.$host.';dbname='.$dbName.';charset=utf8',
                    $username,
                    $password,
                    $pdoOptions
                );
            } catch (\PDOException $exception) {
                die(json_encode(['outcome' => false, 'message' => 'Unable to connect to DB']));
            }
        }
        return self::$instance;
    }
}