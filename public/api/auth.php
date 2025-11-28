<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/controllers/AuthController.php';

$action = $_GET['action'] ?? '';

if ($action == 'register') {
    AuthController::register();
} elseif ($action == 'login') {
    AuthController::login();
} elseif ($action == 'logout') {
    AuthController::logout();
}
