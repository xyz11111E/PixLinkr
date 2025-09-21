<?php

namespace App\Models;

use PDO;

class User extends Model
{
    public static function loggedIn()
    {
        return isset($_SESSION["user_id"]);
    }

    public static function getUserById($id)
    {
        $stmt = self::getConn()->prepare("SELECT * FROM users WHERE id = :a LIMIT 1");
        $stmt->execute([":a" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}