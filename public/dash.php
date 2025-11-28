<?php
require $_SERVER['DOCUMENT_ROOT'] . '/BigP/config/env.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <script>
        window.vapidPublicKey = "<?= $_ENV['VAPID_PUBLIC_KEY'] ?>";
    </script>
</head>

<body>

    <h2>Tambah Event</h2>

    <form action="api/events.php?action=create" method="POST">
        <input name="judul" placeholder="Judul Event" required><br>
        <input name="kategori" placeholder="Kategori" required><br>
        <input type="datetime-local" name="tanggal" required><br>
        <input name="lokasi" placeholder="Lokasi" required><br>
        <input name="kuota" type="number" placeholder="Kuota" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>
        <button type="submit">Tambah Event</button>
    </form>

    <hr>

    <h2>Data Event</h2>

    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Kuota</th>
        </tr>

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/models/Events.php';
        $data = EventModel::getAll();
        ?>

        <table border="1">
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Aksi</th>
            </tr>

            <?php foreach ($data as $row): ?>
                <tr>
                    <form action="api/events.php?action=update" method="POST">
                        <td><input name="judul" value="<?= $row['judul_event'] ?>"></td>
                        <td><input name="kategori" value="<?= $row['kategori'] ?>"></td>
                        <td><input type="datetime-local" name="tanggal" value="<?= date('Y-m-d\TH:i', strtotime($row['tanggal'])) ?>"></td>
                        <td><input name="lokasi" value="<?= $row['lokasi'] ?>"></td>
                        <td><input name="kuota" value="<?= $row['kuota'] ?>"></td>

                        <td>
                            <input type="hidden" name="id_event" value="<?= $row['id_event'] ?>">
                            <input type="hidden" name="deskripsi" value="<?= $row['deskripsi'] ?>">

                            <button type="submit">✏️ Update</button>
                    </form>

                    <form action="api/events.php?action=delete" method="POST" style="display:inline">
                        <input type="hidden" name="id_event" value="<?= $row['id_event'] ?>">
                        <button type="submit" onclick="return confirm('Hapus event ini?')">🗑️ Hapus</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach; ?>


        </table>

        <hr>
        <h2>Statistik Pendaftaran Event</h2>

        <pre>
        <?php
        $data = file_get_contents("http://localhost/BigP/public/api/analytics.php");
        echo $data;
        ?>
        </pre>
</body>

</html>