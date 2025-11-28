<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/controllers/EventController.php';

$action = $_GET['action'] ?? '';

if ($action === 'list') {
    EventController::index();
} elseif ($action === 'create') {
    EventController::store();
} elseif ($action === 'update') {
    EventController::update();
} elseif ($action === 'delete') {
    EventController::destroy();
}
