<?php
// Mulai sesi PHP untuk manajemen sesi.
session_start();

// Kelas DatabaseConnection untuk mengelola koneksi ke database.
class DatabaseConnection {
    private $connection;

    // Konstruktor untuk membuat koneksi ke database.
    public function __construct($servername, $username, $password, $database) {
        $this->connection = new mysqli($servername, $username, $password, $database);

        // Periksa apakah koneksi berhasil, jika tidak, hentikan eksekusi dan tampilkan pesan kesalahan.
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Metode untuk mendapatkan objek koneksi.
    public function getConnection() {
        return $this->connection;
    }

    // Metode untuk menutup koneksi ke database.
    public function closeConnection() {
        $this->connection->close();
    }
}

// Kelas UserRegistration untuk melakukan registrasi pengguna.
class UserRegistration {
    private $databaseConnection;

    // Konstruktor untuk menerima objek DatabaseConnection saat pembuatan instance.
    public function __construct(DatabaseConnection $databaseConnection) {
        $this->databaseConnection = $databaseConnection;
    }

    // Metode untuk mendaftarkan pengguna baru.
    public function registerUser($username, $password) {
        // Hash password menggunakan algoritma default.
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Persiapkan pernyataan SQL untuk menyisipkan data pengguna ke dalam tabel 'users'.
        $stmt = $this->databaseConnection->getConnection()->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        // Eksekusi pernyataan SQL dan periksa keberhasilan.
        if ($stmt->execute()) {
            $stmt->close();
            return null; // Registrasi berhasil, kembalikan null untuk tidak ada error.
        } else {
            $error = "Registration failed. Please try again.";
        }

        $stmt->close();
        return $error;
    }
}

// Inisialisasi variabel error dan successMessage untuk menangani pesan kesalahan atau keberhasilan.
$error = $successMessage = '';

// Cek apakah metode HTTP yang digunakan adalah POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai username dan password dari formulir pendaftaran.
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Buat objek DatabaseConnection untuk mengelola koneksi ke database "dbusers".
    $databaseConnection = new DatabaseConnection("localhost", "root", "", "dbusers");

    // Jika koneksi berhasil dibuat, lanjutkan dengan proses registrasi.
    if ($databaseConnection) {
        // Buat objek UserRegistration dan lakukan registrasi pengguna.
        $registration = new UserRegistration($databaseConnection);
        $error = $registration->registerUser($username, $password);

        // Jika tidak ada error, tampilkan pesan keberhasilan.
        if (empty($error)) {
            $successMessage = "Registration successful! You can now login.";
        }

        // Tutup koneksi ke database setelah selesai.
        $databaseConnection->closeConnection();
    } else {
        // Jika koneksi database gagal, atur pesan kesalahan.
        $error = "Database connection error. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container my-5">
        <h2>User Registration</h2>
        <?php if (!empty($error)) { ?>
            <!-- Tampilkan pesan error jika ada. -->
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php } elseif (!empty($successMessage)) { ?>
            <!-- Tampilkan pesan keberhasilan jika ada. -->
            <div class="alert alert-success" role="alert">
                <?= $successMessage ?>
            </div>
        <?php } ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
