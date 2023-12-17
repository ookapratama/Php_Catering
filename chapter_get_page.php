<?php
require_once("./conn.php");
if (!empty($_POST['id'])) {
        byIdPage($_POST);
}
