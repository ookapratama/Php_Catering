<?php
require_once("./conn.php");
if (isset($_POST['nama']) && isset($_POST['harga']) && isset($_POST['menu']) && isset($_FILES['gambar'])) {
        echo update_paket($_POST, $_FILES['gambar']);
} else {
        echo json_encode(array('success' => 0));
}
