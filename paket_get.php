<?php
require_once("./conn.php");
if (!empty($_POST['action']) && $_POST['action'] == 'formNew') {
        show_paket();
} else if (!empty($_POST['action']) && $_POST['action'] == 'byOne' && !empty($_POST['id'])) {
        byId($_POST, 'paket');
}
