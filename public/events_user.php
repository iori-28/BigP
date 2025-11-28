<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/BigP/models/Events.php';
$data = EventModel::getAll();
?>

<h2>Daftar Event</h2>

<?php foreach ($data as $row): ?>
    <form action="api/registrations.php" method="POST">
        <b><?= $row['judul_event'] ?></b> | <?= $row['kategori'] ?> | <?= $row['tanggal'] ?>
        <input type="hidden" name="id_event" value="<?= $row['id_event'] ?>">
        <button type="submit">Daftar</button>
    </form>
    <hr>
<?php endforeach; ?>