<?php
require_once("./conn.php");
if (isset($_POST['username']) && isset($_POST['email'])) {
        echo profile_setting();
} else if (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])) {
        if ($_POST['password1'] != $_POST['password2']) {
                echo json_encode(array('success' => 2));
        } else {
                echo password_setting();
        }
} else {
        echo json_encode(array('success' => 0));
}
