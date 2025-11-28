<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'] ?? 1;

$pdo = Database::connect();

$stmt = $pdo->prepare("
  INSERT INTO push_subscriptions (user_id, endpoint, p256dh, auth)
  VALUES (?, ?, ?, ?)
");

$stmt->execute([
    $user_id,
    $data['endpoint'],
    $data['keys']['p256dh'],
    $data['keys']['auth']
]);

echo json_encode(['status' => 'ok']);
