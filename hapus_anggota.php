<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "majelis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM anggota_majelis WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Anggota berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: index.php?status=' . $status);

$conn->close();
?>
