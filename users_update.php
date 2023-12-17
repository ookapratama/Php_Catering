<?php
require_once("./conn.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
        echo update_user($_POST, "2");
} else {
        echo json_encode(array('success' => 0));
}
