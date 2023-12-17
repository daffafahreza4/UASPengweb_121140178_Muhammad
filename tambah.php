<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "speklaptop";

    $connection = new mysqli($servername, $username, $password, $database);

    $NamaLaptop = $CPU = $GPU = $RAM = $Storage = $Berat = $Harga = "";
    $errorMessage = $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handlePostRequest();
    }

    function handlePostRequest() {
        global $NamaLaptop, $CPU, $GPU, $RAM, $Storage, $Berat, $Harga, $connection, $errorMessage, $successMessage;

        $NamaLaptop = $_POST["NamaLaptop"];
        $CPU = $_POST["CPU"];
        $GPU = $_POST["GPU"];
        $RAM = $_POST["RAM"];
        $Storage = $_POST["Storage"];
        $Berat = $_POST["Berat"];
        $Harga = $_POST["Harga"];

        if (validateInput()) {
            if (insertData()) {
                $successMessage = "Semua data berhasil dimasukkan";
                header("location: /UASPEMWEB/index.php");
                exit;
            } else {
                $errorMessage = "Invalid query: " . $connection->error;
            }
        } else {
            $errorMessage = "Semua kolom harus diisi";
        }
    }

    function validateInput() {
        global $NamaLaptop, $CPU, $GPU, $RAM, $Storage, $Berat, $Harga;
        return !empty($NamaLaptop) && !empty($CPU) && !empty($GPU) && !empty($RAM) && !empty($Storage) && !empty($Berat) && !empty($Harga);
    }

    function insertData() {
        global $connection, $NamaLaptop, $CPU, $GPU, $RAM, $Storage, $Berat, $Harga;
        $sql = "INSERT INTO laptop (NamaLaptop, CPU, GPU, RAM, Storage, Berat, Harga) VALUES ('$NamaLaptop', '$CPU', '$GPU', '$RAM', '$Storage', '$Berat', '$Harga')";
        return $connection->query($sql);    
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TambahSpesifikasiLaptop</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container my-5">
            <h2>Tambah Laptop</h2>

            <?php if (!empty($errorMessage)): ?>
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong><?= $errorMessage ?></strong>
                    <button type="button" id="removeRequiredBtn" class="btn btn-warning">Remove Required</button>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">NamaLaptop</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="NamaLaptop" value="<?php echo $NamaLaptop; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">CPU</label>
                    <div class="col-sm-6">
                    <textarea name="CPU"></textarea><?php echo $CPU; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">GPU</label>
                    <div class="col-sm-6">
                    <textarea name="GPU"></textarea><?php echo $GPU; ?>
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

                <?php if (!empty($successMessage)): ?>
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Success</strong>
                                <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');

    function removeRequired() {
      inputs.forEach(function(input) {
        input.removeAttribute('required');
      });
    }

    document.getElementById('removeRequiredBtn').addEventListener('click', function() {
      removeRequired();
    });
    });
    </script>
</html>
