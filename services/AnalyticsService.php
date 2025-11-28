<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';

class AnalyticsService
{

    public static function eventRegistrations()
    {
        $db = Database::connect();
        $stmt = $db->query("
            SELECT e.judul_event, COUNT(r.id_daftar) AS total 
            FROM events e
            LEFT JOIN registrations r ON e.id_event = r.id_event 
            GROUP BY e.id_event
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
