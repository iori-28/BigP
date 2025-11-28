<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/models/Users.php';

class AuthController
{

    public static function register()
    {
        $nama     = $_POST['nama'] ?? '';
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$nama || !$email || !$password) {
            echo json_encode(['status' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        if (User::findByEmail($email)) {
            echo json_encode(['status' => false, 'message' => 'Email sudah terdaftar']);
            return;
        }

        User::create($nama, $email, $password);

        echo json_encode(['status' => true, 'message' => 'Registrasi berhasil']);
    }

    public static function login()
    {
        session_start();

        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            echo json_encode(['status' => false, 'message' => 'Login gagal']);
            return;
        }

        $_SESSION['user'] = [
            'id'    => $user['id_user'],
            'nama'  => $user['nama'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];

        echo json_encode(['status' => true, 'role' => $user['role']]);
    }

    public static function logout()
    {
        session_start();
        session_destroy();
        echo json_encode(['status' => true]);
    }
}
