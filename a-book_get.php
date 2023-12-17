<?php
require_once("./conn.php");
if (!empty($_POST['action']) && $_POST['action'] == 'formNew') {
        show_Books();
} else if (!empty($_POST['action']) && $_POST['action'] == 'byOne' && !empty($_POST['id'])) {
        byId($_POST, 'books');
}
