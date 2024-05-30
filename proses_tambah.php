<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "majelis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_anggota = $_POST['id_anggota'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tempat_tanggal_lahir = $_POST['tempat_tanggal_lahir'];
$status_nikah = $_POST['status_nikah'];
$no_telepon = $_POST['no_telepon'];
$alamat = $_POST['alamat'];
$acara = implode(", ", $_POST['acara']);

$sql = "INSERT INTO anggota_majelis (id_anggota, nama, jenis_kelamin, tempat_tanggal_lahir, status_nikah, no_telepon, alamat, acara) VALUES ('$id_anggota', '$nama', '$jenis_kelamin', '$tempat_tanggal_lahir', '$status_nikah','$no_telepon', '$alamat', '$acara')";

if ($conn->query($sql) === TRUE) {
    $status = "success";
    echo "Anggota berhasil ditambahkan";
} else {
    $status = "error";
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: index.php?status=' . $status);

$conn->close();
?>