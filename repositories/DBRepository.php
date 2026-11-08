<?php

// Parent class of all repositories. It knows how to connect to the database.
class DBRepository {

    private static ?PDO $pdo = null;

    // Returns the database connection (it is created only once)
    //php data object 
    protected static function connect(): PDO
    {
        if (self::$pdo === null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die('Cannot connect to the database. Is MySQL running in XAMPP? ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}