<?php
// Memulai sesi PHP.
session_start();

// Menghapus semua variabel sesi yang terdaftar.
session_unset();

// Menghancurkan sesi, menghapus semua data sesi yang ada.
session_destroy();

// Mengarahkan pengguna ke halaman login.php setelah keluar dari sesi.
header('Location: /UASPEMWEB/login.php');
exit();
?>
