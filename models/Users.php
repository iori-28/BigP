<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';

class User
{

    public static function findByEmail($email)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($nama, $email, $password)
    {
        $db = Database::connect();
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $email, $hash]);
    }
}
