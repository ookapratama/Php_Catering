<?php
require_once("./conn.php");
if (isset($_POST['user']) && isset($_POST['paket']) && isset($_FILES['pembayaran'])) {
        // var_dump($_POST);
        echo create_Confirm_User($_POST, $_FILES['pembayaran']);
} else {
        echo json_encode(array('success' => 0));
}
