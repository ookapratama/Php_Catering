<?php
require_once("./conn.php");
if (!empty($_POST['action']) && $_POST['action'] == 'formNew') {
        show_pesanan();
} else if (!empty($_POST['action']) && $_POST['action'] == 'byOne' && !empty($_POST['id'])) {
        byIdForPesanan($_POST, 'pesanan');
}
