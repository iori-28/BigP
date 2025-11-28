<?php
require __DIR__ . '/vendor/autoload.php';

use Minishlink\WebPush\VAPID;

$keys = VAPID::createVapidKeys();

echo "=== VAPID KEYS ===\n\n";
echo "PUBLIC KEY:\n" . $keys['publicKey'] . "\n\n";
echo "PRIVATE KEY:\n" . $keys['privateKey'] . "\n";
