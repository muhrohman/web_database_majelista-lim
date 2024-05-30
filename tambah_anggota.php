<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
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
            border: 1px solid grey;
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
            background-color: blue;
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
            background-color: blue lightskyblue;
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
        <h1>Tambah Anggota Baru</h1>
        <form id="myForm" action="proses_tambah.php" method="post">
            <div>
                <label for="id_anggota">ID Anggota</label>
                <input type="text" id="id_anggota" name="id_anggota" required>
            </div>
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div>
                <label for="tempat_tanggal_lahir">TTL</label>
                <input type="text" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" required>
            </div>
            <div>
                <label>Status</label>
                <div>
                    <input type="radio" id="sudah_menikah" name="status_nikah" value="Sudah Menikah" required>
                    <label for="sudah_menikah">Sudah Menikah</label>
                </div>
                <div>
                    <input type="radio" id="belum_menikah" name="status_nikah" value="Belum Menikah" required>
                    <label for="belum_menikah">Belum Menikah</label>
                </div>
            </div>
            <div>
                <label for="no_telepon">No Telp</label>
                <input type="text" id="no_telepon" name="no_telepon" required>
            </div>
            <div>
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="4" required></textarea>
            </div>
            <div>
                <label for="acara">Acara</label>
                <div>
                    <input type="checkbox" id="acara1" name="acara[]" value="Saat Ramadhan">
                    <label for="acara1">Saat Ramadhan</label>
                </div>
                <div>
                    <input type="checkbox" id="acara2" name="acara[]" value="Setiap Malam Kamis">
                    <label for="acara2">Setiap Malam Kamis</label>
                </div>
            </div>
            <div>
                <input type="submit" value="Tambahkan Anggota">
            </div>
            <div class="success-message" id="successMessage">Data berhasil disimpan!</div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#myForm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'proses_tambah.php',
                    data: $(this).serialize(),
                    success: function(response){
                        $('#successMessage').fadeIn();
                        setTimeout(function(){
                            $('#successMessage').fadeOut();
                            window.location.href = "index.php";
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>
