<?php session_start();
class Mahasiswa
{
    private $comn;
    private $table_name = "mahasiswa";
    public $id;
    public $nim;
    public $name;
    public $jurusan;

    public function __construct($db)
    {
        $this->comn = $db;
    }

    private function isDuplicate($nim, $name, $id = null)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE (nim = ? OR name = ?)" . ($id ? " AND id != ?" : "");
        $stmt = $this->comn->prepare($query);
        $id ? $stmt->bind_param("ss", $nim, $name, $id) : $stmt->bind_param("ss", $nim, $name);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function create()
    {
        if ($this->isDuplicate($this->nim, $this->name)) {
            $_SESSION['flash_message'] = "NIN atau Mama sudah ada dalam database!";
            header("Location: ", BASE_URL, "index.php?msg=0");
            return;
        }
        $query = "INSERT INTO " . $this->table_name . " SET nim=?, name=?, jurusan=?";
        $stmt = $this->comn->prepare($query);
        $stmt->bind_param("ss", $this->nim, $this->name, $this->jurusan);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Data berhasil disimpan!";
            header("Location: ", BASE_URL, "index.php?msg=1");
        } else {
            $_SESSION['flash_message'] = "Data gagal disimpan!";
            header("Location: ", BASE_URL, "index.php?msg=0");
        }
    }




    public function read($id = null)
    {
        $query = "SELECT * FROM " . $this->table_name;
        if ($id) {
            $query .= " WHERE id = ?";
        }
        $stmt = $this->conn->prepare($query);
        if ($id) {
            $stmt->bind_param("s", $id);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function update()
    {
        if ($this->isDuplicate($this->nim, $this->name, $this->id)) {
            $_SESSION['flash_message'] = "NIM atau Nama sudah ada dalam database!";
            header("Location: " . BASE_URL . "index.php?msg=0");
            return;
        }
        $query = "UPDATE " . $this->table_name . " SET nim=?, name=?, jurusan=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->nim, $this->name, $this->jurusan, $this->id);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Data berhasil diupdate!";
            header("Location: " . BASE_URL . "index.php?msg=1");
        } else {
            $_SESSION['flash_message'] = "Data gagal diupdate!";
            header("Location: " . BASE_URL . "index.php?msg=0");
        }
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        if ($stmt->execute()) {
            $_SESSION['flash_message'] = "Data berhasil dihapus!";
            header("Location: " . BASE_URL . "index.php?msg=1");
        } else {
            $_SESSION['flash_message'] = "Data gagal dihapus!";
            header("Location: " . BASE_URL . "index.php?msg=0");
        }
    }
}

?>