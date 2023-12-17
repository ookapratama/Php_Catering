<?php
require_once("./conn.php");
if (isset($_POST)) {
        echo update_pesanan($_POST);
} else {
        echo json_encode(array('success' => 0));
}
