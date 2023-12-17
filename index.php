<?php
// Memulai sesi PHP untuk manajemen data sesi.
session_start();

// Kelas untuk manajemen koneksi database.
class DatabaseConnection {
    private $connection;

    // Konstruktor kelas DatabaseConnection untuk membuat koneksi ke database.
    public function __construct($servername, $username, $password, $database) {
        $this->connection = new mysqli($servername, $username, $password, $database);

        // Memeriksa kegagalan koneksi.
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Fungsi untuk mendapatkan objek koneksi.
    public function getConnection() {
        return $this->connection;
    }

    // Fungsi untuk menutup koneksi.
    public function closeConnection() {
        $this->connection->close();
    }
}

// Kelas untuk manipulasi data laptop.
class LaptopData {
    private $connection;

    // Konstruktor kelas LaptopData untuk menerima objek DatabaseConnection.
    public function __construct(DatabaseConnection $connection) {
        $this->connection = $connection;
    }

    // Fungsi untuk mengambil data laptop dari database.
    public function fetchLaptopData() {
        $sql = "SELECT * FROM laptop";
        $result = $this->connection->getConnection()->query($sql);

        // Memeriksa kegagalan query.
        if (!$result) {
            die("Invalid query: " . $this->connection->getConnection()->error);
        }

        return $result;
    }

    // Fungsi untuk menampilkan data laptop dalam bentuk tabel HTML.
    public function displayTable($result) {
        $number = 1;
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $number ?></td>
                <td><?= $row['NamaLaptop'] ?></td>
                <td><?= $row['CPU'] ?></td>
                <td><?= $row['GPU'] ?></td>
                <td><?= $row['RAM'] ?> GB</td>
                <td><?= $row['Storage'] ?></td>
                <td><?= $row['Berat'] ?> kg</td>
                <td><?= $row['Harga'] ?></td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/UASPEMWEB/edit.php?id=<?= $row['id'] ?>'>
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                    <a class='btn btn-danger btn-sm' href='/UASPEMWEB/delete.php?id=<?= $row['id'] ?>'>
                        <i class="fa fa-trash"></i>
                        Delete
                    </a>
                </td>
            </tr>
            <?php
            $number++; 
        }
    }
}

// Membuat objek DatabaseConnection dan LaptopData.
$databaseConnection = new DatabaseConnection("localhost", "root", "", "speklaptop");
$laptopData = new LaptopData($databaseConnection);

// Mengambil data laptop dari database.
$result = $laptopData->fetchLaptopData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Informasi-informasi meta dan title HTML. -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spesifikasi Laptop</title>
    
    <!-- Pemanggilan file CSS eksternal. -->
    <link rel="stylesheet" href="style.css">
    
    <!-- CSS inline untuk toggle night mode. -->
    <style>
        body {
            transition: background-color 0.5s ease;
        }

        .night-mode {
            background-color: #2c3e50;
            color: #ecf0f1; 
        }
    </style>
</head>
<body>
    <!-- Container utama. -->
    <div class="container my-5">
        <!-- Judul halaman. -->
        <h2>Spesifikasi Laptop</h2>

        <!-- Tombol untuk toggle night mode. -->
        <button class="btn btn-success" onclick="toggleNightMode()">
            <i class="fa fa-adjust"></i>
            Toggle Night Mode
        </button>

        <!-- Tombol untuk tambah laptop. -->
        <a class="btn btn-success" href="/UASPEMWEB/tambah.php" role="button">
            <i class="fa fa-plus"></i>
            Tambah Laptop
        </a>

        <br>

        <!-- Tabel untuk menampilkan data laptop. -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NamaLaptop</th>
                    <th>CPU</th>
                    <th>GPU</th>
                    <th>RAM</th>
                    <th>Storage</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data laptop dalam bentuk tabel.
                $laptopData->displayTable($result);
                
                // Menutup koneksi ke database.
                $databaseConnection->closeConnection();
                ?>
            </tbody>
        </table>    

        <!-- Tombol logout. -->
        <div class="text-end">
            <p><a class="btn btn-outline-danger" href="logout.php">Logout</a></p>
        </div>
    </div>

    <!-- Skrip JavaScript untuk toggle night mode. -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var nightModeButton = document.querySelector('.btn-success');
            var body = document.body;
            nightModeButton.addEventListener('click', function () {
                body.classList.toggle('night-mode');
            });
        });
    </script>
</body>
</html>
