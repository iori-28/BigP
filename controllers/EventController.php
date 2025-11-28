<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/models/Events.php';

class EventController
{

    public static function index()
    {
        $data = EventModel::getAll();
        echo json_encode($data);
    }

    public static function store()
    {
        session_start();

        if ($_SESSION['user']['role'] !== 'admin') {
            echo json_encode(['status' => false, 'message' => 'Akses ditolak']);
            return;
        }

        $judul    = $_POST['judul'] ?? '';
        $kategori = $_POST['kategori'] ?? '';
        $tanggal  = $_POST['tanggal'] ?? '';
        $lokasi   = $_POST['lokasi'] ?? '';
        $kuota    = $_POST['kuota'] ?? 0;
        $desk     = $_POST['deskripsi'] ?? '';
        $admin_id = $_SESSION['user']['id'];

        EventModel::create($judul, $kategori, $tanggal, $lokasi, $kuota, $desk, $admin_id);

        echo json_encode(['status' => true, 'message' => 'Event berhasil ditambahkan']);
    }

    public static function update()
    {
        $id       = $_POST['id_event'];
        $judul    = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $tanggal  = $_POST['tanggal'];
        $lokasi   = $_POST['lokasi'];
        $kuota    = $_POST['kuota'];
        $desk     = $_POST['deskripsi'];

        EventModel::update($id, $judul, $kategori, $tanggal, $lokasi, $kuota, $desk);

        echo json_encode(['status' => true]);
    }

    public static function destroy()
    {
        $id = $_POST['id_event'];
        EventModel::delete($id);
        echo json_encode(['status' => true]);
    }
}
