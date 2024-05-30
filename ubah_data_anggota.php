<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "majelis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM anggota_majelis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        exit();
    }
} else {
    echo "ID tidak ditemukan";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }

        h1 {
            text-align: center;
            color: black;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            color: black;
        }

        input[type="text"],
        select,
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid silver;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: orange;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: orange;
        }

        .success-message {
            display: none;
            background-color: green;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ubah Anggota</h1>
        <form id="ubahForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $row['id']; ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div>
                <label>ID Anggota</label>
                <input type="text" name="id_anggota" value="<?php echo $row['id_anggota']; ?>" required>
            </div>
            <div>
                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" <?php if($row['jenis_kelamin'] == "Laki-laki") echo "selected"; ?>>Laki-Laki</option>
                    <option value="Perempuan" <?php if($row['jenis_kelamin'] == "Perempuan") echo "selected"; ?>>Perempuan</option>
                </select>
            </div>
            <div>
                <label>TTL</label>
                <input type="text" name="tempat_tanggal_lahir" value="<?php echo $row['tempat_tanggal_lahir']; ?>" required>
            </div>
            <div>
                <label>Status</label>
            </div>
            <div>
                <input type="radio" name="status_nikah" value="Sudah Menikah" <?php if($row['status_nikah'] == "Sudah Menikah") echo "checked"; ?> required> Sudah Menikah
            </div>
            <div>
                <input type="radio" name="status_nikah" value="Belum Menikah" <?php if($row['status_nikah'] == "Belum Menikah") echo "checked"; ?> required> Belum Menikah
            </div>
            <div>
                <label>No Telp</label>
                <input type="text" name="no_telepon" value="<?php echo $row['no_telepon']; ?>" required>
            </div>
            <div>
                <label>Alamat</label>
                <textarea name="alamat" cols="30" rows="10"><?php echo $row['alamat']; ?></textarea>
            </div>
            <div>
                <label>Acara</label>
            </div>
            <div>
                <input type="checkbox" name="acara[]" value="Saat Ramadhan" <?php if(strpos($row['acara'], 'Saat Ramadhan') !== false) echo "checked"; ?>> Saat Ramadhan
            </div>
            <div>
                <input type="checkbox" name="acara[]" value="Setiap Malam Kamis" <?php if(strpos($row['acara'], 'Setiap Malam Kamis') !== false) echo "checked"; ?>> Setiap Malam Kamis
            </div>
            <div>
                <input type="submit" value="Ubah">
            </div>
        </form>
    </div>

    <div class="success-message" id="successMessage">Data berhasil diubah!</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ubahForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#successMessage').fadeIn().delay(2000).fadeOut(function () {
                            window.location.href = 'index.php';
                        });
                    }
                });
            });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $id_anggota = $_POST['id_anggota'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
        $status_nikah = $_POST['status_nikah'];
        $no_telepon = $_POST['no_telepon'];
        $alamat = $_POST['alamat'];
        $acara = implode(", ", $_POST['acara']);

        $sql = "UPDATE anggota_majelis SET id_anggota=?, nama=?, jenis_kelamin=?, tempat_tanggal_lahir=?, status_nikah=?, no_telepon=?, alamat=?, acara=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $id_anggota, $nama, $jenis_kelamin, $tempat_tanggal_lahir, $status_nikah, $no_telepon, $alamat, $acara, $id);

        if ($stmt->execute()) {
            echo "Data berhasil diubah";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>