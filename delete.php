<?php
// Pengecekan apakah metode HTTP yang digunakan adalah GET dan apakah parameter 'id' sudah diatur.
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    
    // Mendapatkan nilai 'id' dari parameter GET.
    $id = $_GET['id'];

    // Informasi koneksi ke database MySQL.
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "speklaptop";

    // Membuat koneksi ke database.
    $connection = new mysqli($servername, $username, $password, $database);

    // Memeriksa apakah koneksi berhasil.
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Pernyataan SQL DELETE untuk menghapus data dari tabel "laptop" berdasarkan ID.
    $sql = "DELETE FROM laptop WHERE id = $id";
    $connection->query($sql);

    // Menutup koneksi ke database setelah penghapusan selesai.
    $connection->close();
}

// Mengarahkan kembali ke halaman utama setelah operasi penghapusan.
header("location:/UASPEMWEB/index.php");
exit;
?>
