<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';

class RegistrationController
{

    public static function register()
    {
        session_start();

        $user_id  = $_SESSION['user']['id'];
        $event_id = $_POST['id_event'];

        $db = Database::connect();

        $stmt = $db->prepare("INSERT INTO registrations (id_user, id_event) VALUES (?, ?)");
        $stmt->execute([$user_id, $event_id]);

        echo json_encode(['status' => true, 'message' => 'Berhasil mendaftar event']);
    }
}
