<?php
include_once  '../config/Database.php';
include '../config/Config.php';
include_once '../model/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();
$mahasiswa = new Mahasiswa($db);

if (isset($_GET['action'])) {
     if ($_GET['action'] == 'create'){
        $mahasiswa->nim = $_POST['nim'];
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->jurusan = $_POST['jurusan'];
        $mahasiswa->create();
     }elseif ($_GET['action'] == 'delete'){
        $mahasiswa->id = $_GET['id'];
        $mahasiswa->delete();
     }elseif ($_GET['action'] == 'update'){
        $mahasiswa->id = $_POST['id'];
        $mahasiswa->nim = $_POST['nim'];
        $mahasiswa->nama = $_POST['nama'];
        $mahasiswa->jurusan = $_POST['jurusan'];
        $mahasiswa->update();
     }
}