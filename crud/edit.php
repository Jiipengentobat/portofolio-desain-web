<?php
include_once './config/Database.php';
include_once './model/Mahasiswa.php';
$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);
if (isset($_GET['id'])) {
    $result = $mahasiswa->read($_GET['id'])->fetch_assoc();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP - Edit</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <h1>Edit Mahasiswa</h1>
            <form action="function/Mahasiswa.php?action=update" method="post">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="hidden" class="form-control" name="id" value="<?= $result['id']; ?>" required>
                    <input type="text" class="form-control" name="nim" value="<?= $result['nim']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?= $result['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" value="<?= $result['jurusan']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-
k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>