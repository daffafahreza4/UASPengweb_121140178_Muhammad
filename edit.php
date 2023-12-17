<?php
// Informasi koneksi ke database MySQL.
$servername = "localhost";
$username = "root";
$password = "";
$database = "speklaptop";

// Membuat koneksi ke database.
$connection = new mysqli($servername, $username, $password, $database);

// Inisialisasi variabel-variabel untuk data laptop dan pesan kesalahan/keberhasilan.
$NamaLaptop = $CPU = $GPU = $RAM = $Storage = $Berat = $Harga = "";
$errorMessage = $successMessage = "";

// Mendapatkan nilai 'id' dari parameter GET atau POST.
$id = isset($_GET["id"]) ? $_GET["id"] : null;

// Memproses permintaan POST untuk menyimpan perubahan data.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $NamaLaptop = $_POST["NamaLaptop"];
    $CPU = $_POST["CPU"];
    $GPU = $_POST["GPU"];
    $RAM = $_POST["RAM"];
    $Storage = $_POST["Storage"];
    $Berat = $_POST["Berat"];
    $Harga = $_POST["Harga"];

    do {
        // Memeriksa apakah semua kolom diisi.
        if (empty($id) || empty($NamaLaptop) || empty($CPU) || empty($GPU) || empty($RAM) || empty($Storage) || empty($Berat) || empty($Harga)) {
            $errorMessage = "Semua kolom harus diisi";
            break;
        }

        // Pernyataan SQL UPDATE untuk mengubah data di tabel "laptop".
        $sql = "UPDATE laptop SET NamaLaptop = '$NamaLaptop', CPU = '$CPU', GPU = '$GPU', RAM = '$RAM', Storage = '$Storage', Berat = '$Berat', Harga = '$Harga' WHERE id = $id";
        $result = $connection->query($sql);

        // Memeriksa keberhasilan eksekusi query.
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Data berhasil diubah";

        // Mengarahkan kembali ke halaman utama setelah operasi pengubahan selesai.
        header("location: /UASPEMWEB/index.php");
        exit;
    } while (false);
} 
// Memproses permintaan GET untuk mendapatkan data laptop yang akan diubah.
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $id) {
    // Pernyataan SQL SELECT untuk mendapatkan data laptop berdasarkan ID.
    $sql = "SELECT * FROM laptop WHERE id = $id";
    $result = $connection->query($sql);

    // Mendapatkan satu baris data sebagai array asosiatif.
    $row = $result->fetch_assoc();

    // Memeriksa apakah data ditemukan berdasarkan ID.
    if (!$row) {
        // Mengarahkan kembali ke halaman utama jika data tidak ditemukan.
        header("location: /UASPEMWEB/index.php");
        exit;
    }

    // Mengisi variabel-variabel dengan nilai dari database untuk ditampilkan dalam form.
    $NamaLaptop = $row["NamaLaptop"];
    $CPU = $row["CPU"];
    $GPU = $row["GPU"];
    $RAM = $row["RAM"];
    $Storage = $row["Storage"];
    $Berat = $row["Berat"];
    $Harga = $row["Harga"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h2>Ubah Deskripsi Laptop</h2>

        <?php
        // Menampilkan pesan kesalahan jika ada.
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <!-- Input tersembunyi untuk menyimpan nilai 'id'. -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Form untuk mengubah data laptop. -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">NamaLaptop</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NamaLaptop" value="<?php echo $NamaLaptop; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">CPU</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CPU" value="<?php echo $CPU; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">GPU</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="GPU" value="<?php echo $GPU; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">RAM</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="RAM" value="<?php echo $RAM; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Storage</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Storage" value="<?php echo $Storage; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Berat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Berat" value="<?php echo $Berat; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Harga" value="<?php echo $Harga; ?>">
                </div>
            </div>

            <?php
            // Menampilkan pesan keberhasilan jika ada.
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success</strong>
                            <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <!-- Tombol untuk menyimpan perubahan atau membatalkan. -->
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/UASPEMWEB/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
