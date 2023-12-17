<?php
require_once("./conn.php");
if (isset($_POST['id_booking'])) {
        if($_POST['del']=='pesanan')
        echo deletes_pesanan($_POST['id_booking'], $_POST['del']);
        else
        echo deletes($_POST['id'], $_POST['del']);
} else {
        echo json_encode(array('success' => 0));
}
