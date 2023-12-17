<?php
require_once("./conn.php");
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        echo register($_POST);
} else {
        echo json_encode(array('success' => 0));
}
