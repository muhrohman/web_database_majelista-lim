<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: white;
        }

        .container {
            max-width: 250px;
            max-height: 250px;
            text-align: center;
        }

        img {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
        }

        header {
            background-color: green;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: green;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: lightgreen;
        }

        .content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid silver;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: green;
            color: white;
        }

        tr:nth-child(even) {
            background-color: white;
        }

        footer {
            background-color: green;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .add-button {
            background-color: blue;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: lightblue;
        }

        .action-link {
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
        }

        .action-link-ubah {
            background-color: orange;
            color: #000;
        }

        .action-link-hapus {
            background-color: red;
            color: white;
        }

        .action-link:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="Majelis Ta’lim.jpg" alt="Logo Majelis Ta'lim">
    </div>
    <section class="content">
        <h2>Daftar Anggota</h2>
        <button class="add-button" onclick="window.location.href='tambah_anggota.php';">Tambah Data</button>
        <?php
        $koneksi = mysqli_connect("localhost", "root", "", "majelis");

        if (mysqli_connect_errno()) {
            echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
            exit();
        }

        $query = "SELECT * FROM anggota_majelis";
        $result = mysqli_query($koneksi, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Nama</th><th>Jenis Kelamin</th><th>Tempat, Tanggal Lahir</th><th>Status Nikah</th><th>No Telepon</th><th>Alamat</th><th>Acara</th><th>Aksi</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_anggota"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["jenis_kelamin"] . "</td>";
                echo "<td>" . $row["tempat_tanggal_lahir"] . "</td>";
                echo "<td>" . $row["status_nikah"] . "</td>";
                echo "<td>" . $row["no_telepon"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["acara"] . "</td>";
                echo "<td><a href='ubah_data_anggota.php?id=" . $row["id"] . "' class='action-link action-link-ubah'>Ubah</a> | <a href='hapus_anggota.php?id=" . $row["id"] . "' class='action-link action-link-hapus'>Hapus</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada anggota yang ditemukan.";
        }

        mysqli_close($koneksi);
        ?>
    </section>
</body>
</html>
