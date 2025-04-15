<?php

namespace App\Models;

use App\Database\Database;

class User {
    public $id;
    public $username;
    public $password;

    public static function findByUsername($username) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetchObject(User::class);
    }
}
