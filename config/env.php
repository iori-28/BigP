<?php

$env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/BigP/.env');

define('DB_HOST', $env['DB_HOST']);
define('DB_USER', $env['DB_USER']);
define('DB_PASS', $env['DB_PASS']);
define('DB_NAME', $env['DB_NAME']);
define('VAPID_PUBLIC_KEY', $env['VAPID_PUBLIC_KEY']);
define('VAPID_PRIVATE_KEY', $env['VAPID_PRIVATE_KEY']);
define('VAPID_SUBJECT', $env['VAPID_SUBJECT']);
