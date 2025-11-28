<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/db.php';

class EventModel
{

    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM events ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM events WHERE id_event = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($judul, $kategori, $tanggal, $lokasi, $kuota, $deskripsi, $admin_id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            INSERT INTO events 
            (judul_event, kategori, tanggal, lokasi, kuota, deskripsi, created_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $judul,
            $kategori,
            $tanggal,
            $lokasi,
            $kuota,
            $deskripsi,
            $admin_id
        ]);
    }

    public static function update($id, $judul, $kategori, $tanggal, $lokasi, $kuota, $deskripsi)
    {
        $db = Database::connect();
        $stmt = $db->prepare("
            UPDATE events SET 
            judul_event=?, kategori=?, tanggal=?, lokasi=?, kuota=?, deskripsi=?
            WHERE id_event=?
        ");
        return $stmt->execute([
            $judul,
            $kategori,
            $tanggal,
            $lokasi,
            $kuota,
            $deskripsi,
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM events WHERE id_event = ?");
        return $stmt->execute([$id]);
    }
}
