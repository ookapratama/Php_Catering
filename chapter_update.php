<?php
require_once("./conn.php");
if (isset($_POST['book']) && isset($_POST['page']) && isset($_POST['content'])) {
        echo update_Chapter($_POST);
} else {
        echo json_encode(array('success' => 0));
}
