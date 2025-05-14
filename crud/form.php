<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa - Create/Update</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <?php
            include_once "./config/Database.php";
            include_once "./model/Mahasiswa.php";

            $database = new Database();
            $db = $database->getConnection();
            $mahasiswa = new Mahasiswa($db);

            $isEdit = isset($_GET['id']);
            $result = ['id' => '', 'nim' => '', 'name' => '', 'jurusan' => ''];
            if ($isEdit) {
                $data = $mahasiswa->read($_GET['id']);
                if ($data) {
                    $result = $data->fetch_assoc();
                } else {
                    echo '<div class="alert alert-danger">Data tidak ditemukan!</div>';
                    exit;
                }
            }

            $action = $isEdit ? 'update' : 'create';
            ?>

            <h1><?= $isEdit ? 'Edit' : 'Create' ?> Mahasiswa</h1>
            <form action="function/Mahasiswa.php?action=<?= $action ?>" method="post">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?= $result['id']; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" name="nim" value="<?= $result['nim']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" name="name" value="<?= $result['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" value="<?= $result['jurusan']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">
                    <?= $isEdit ? 'Update' : 'Create' ?>
                </button>
            </form>

            <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>