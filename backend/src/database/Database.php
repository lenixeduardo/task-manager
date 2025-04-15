<?php

namespace App\Database;

class Database {
    private static $instance;

    public static function connect() {
        if (!self::$instance) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=task_manager', 'root', 'root');
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
