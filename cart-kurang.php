<?php
require_once("./conn.php");
if (isset($_POST['id']) && isset($_POST['jumlah'])) {
    // print("console.log('id: ".$_POST['id']."');");
    echo cart_delete($_POST);
} else {
        echo json_encode(array('success' => 0));
}
