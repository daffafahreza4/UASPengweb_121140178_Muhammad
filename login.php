<?php
// Memulai sesi untuk pengelolaan data sesi.
session_start();

// Kelas DatabaseConnection untuk menangani koneksi ke database.
class DatabaseConnection
{
    private $connection;

    public function __construct($servername, $username, $password, $database)
    {
        // Membuat koneksi ke database MySQL.
        $this->connection = new mysqli($servername, $username, $password, $database);

        // Memeriksa apakah koneksi berhasil.
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Metode untuk mendapatkan objek koneksi.
    public function getConnection()
    {
        return $this->connection;
    }

    // Metode untuk menutup koneksi ke database.
    public function closeConnection()
    {
        $this->connection->close();
    }
}

// Kelas UserLogin untuk menangani proses login pengguna.
class UserLogin
{
    private $connection;

    // Konstruktor menerima objek DatabaseConnection.
    public function __construct(DatabaseConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    // Metode untuk melakukan proses login pengguna.
    public function loginUser($username, $password)
    {
        // Menyiapkan pernyataan SQL untuk mengambil hash kata sandi berdasarkan username.
        $stmt = $this->connection->prepare("SELECT password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Memeriksa kecocokan kata sandi dengan hash yang disimpan.
        if ($hashedPassword && password_verify($password, $hashedPassword)) {
            // Menyimpan username dalam sesi jika login berhasil.
            $_SESSION['username'] = $username;
            return "";
        } else {
            return "Invalid username or password";
        }
    }
}

// Handle login jika metode HTTP adalah POST dan tombol login ditekan.
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Membuat objek DatabaseConnection untuk koneksi ke database "dbusers".
    $databaseConnection = new DatabaseConnection("localhost", "root", "", "dbusers");

    // Memeriksa apakah koneksi ke database berhasil.
    if ($databaseConnection) {
        // Membuat objek UserLogin dengan objek DatabaseConnection.
        $login = new UserLogin($databaseConnection);

        // Melakukan proses login dan mendapatkan pesan error jika ada.
        $error = $login->loginUser($username, $password);

        // Mengarahkan ke halaman utama jika login berhasil.
        if (empty($error)) {
            header("location: /UASPEMWEB/index.php");
            exit();
        }

        // Menutup koneksi ke database setelah pengolahan login selesai.
        $databaseConnection->closeConnection();
    } else {
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
    <title>User Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container my-5">
        <h2>User Login</h2>
        <?php if (!empty($error)) { ?>
            <!-- Menampilkan pesan error jika ada -->
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php } ?>
        <!-- Form login -->
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
        <!-- Tautan untuk registrasi jika belum memiliki akun -->
        <p class="mt-3">Don't have an account? <a href="registrasi.php">Register here</a></p>
    </div>
</body>
</html>
