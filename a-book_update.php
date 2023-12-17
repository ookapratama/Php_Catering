<?php
require_once("./conn.php");
if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['description']) && isset($_FILES['image'])) {
        echo update_book($_POST, $_FILES['image']);
} else {
        echo json_encode(array('success' => 0));
}
