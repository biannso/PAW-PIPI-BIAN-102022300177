<?php
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nim = "";
$namaErr = $emailErr = $nimErr = "";

// **********************  1  **************************  
// Tangkap nilai nama yang ada pada form HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $nim = trim($_POST["nim"]);

    // **********************  2  **************************  
    // Validasi format email agar sesuai dengan standar
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi.";
    }

    if (empty($email)) {
        $emailErr = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid.";
    }

    // **********************  3  **************************  
    // Pastikan NIM terisi dan berupa angka
    if (empty($nim)) {
        $nimErr = "NIM wajib diisi.";
    } elseif (!ctype_digit($nim)) {
        $nimErr = "NIM harus berupa angka.";
    }
}
?>


<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="styles.css">  
</head>



<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <?php if (!empty($namaErr) || !empty($emailErr) || !empty($nimErr)) { ?>
                <div class="alert alert-danger">
                    <strong>Kesalahan!</strong> Harap perbaiki data yang salah.
                </div>
            <?php } else { ?>
                <div class="alert alert-success">
                    <strong>Berhasil!</strong> Data pendaftaran telah diterima.
                </div>
            <?php } ?>
        <?php } ?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        

         <!-- **********************  4  ************************** -->
         <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <small class="error"><?php echo $namaErr; ?></small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <small class="error"><?php echo $emailErr; ?></small>
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>">
                <small class="error"><?php echo $nimErr; ?></small>
            </div>
            <div class="button-container">
                <button type="submit">Daftar</button>
            </div>
        </form>
    </div>
</body>


</html>
