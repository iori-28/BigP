<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/services/AnalyticsService.php';

echo json_encode(AnalyticsService::eventRegistrations());
