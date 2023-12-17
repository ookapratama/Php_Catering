<?php

require("./database.php");

function query($query)
{
        global $connect;
        $data = mysqli_query($connect, $query);
        $data = mysqli_fetch_assoc($data);
        return $data;
}

function query2($query)
{
        global $connect;
        $data = mysqli_query($connect, $query);
        return $data;
}

function get_data($query)
{
        global $connect;
        $hasil = mysqli_query($connect, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($hasil)) {
                $rows[] = $row;
        }
        return $rows;
}

function get_rows($query)
{
        global $connect;
        $data = mysqli_query($connect, $query);
        $data = mysqli_num_rows($data);
        return $data;
}

function login($data)
{
        $name = $data['username'];
        $pass = $data['password'];

        $sql = get_rows("SELECT * FROM users WHERE username='" . $name . "' OR email='" . $name . "' AND pass='" . $pass . "'");
        if ($sql > 0) {
                session_start();
                $data = query("SELECT * FROM users WHERE username='" . $name . "' AND pass='" . $pass . "'");
                $_SESSION['username'] = $data['username'];
                $_SESSION['l'] = $data['role'];
                $_SESSION['i'] = $data['id'];
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function register($data)
{
        global $connect;
        $username = $data['username'];
        $pass = $data['password'];
        $email = $data['password'];

        $sql = get_rows("SELECT * FROM users WHERE username='" . $username . "' OR email='" . $email . "'");
        if ($sql == 0) {
                session_start();
                $data = mysqli_query($connect, "INSERT INTO `users` (`username`, `pass`, `email`, `role`) VALUES ('" . $username . "','" . $pass . "', '" . $email . "', '2')");
                $v = query("SELECT * FROM users WHERE username='" . $username . "' OR email='" . $email . "'");
                $_SESSION['username'] = $username;
                $_SESSION['i'] = $v['id'];
                $_SESSION['l'] = 2;
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function show_user()
{
        global $connect;
        $data = "SELECT * FROM `users` WHERE `role`='2' ";
        if (!empty($_POST["search"]["value"])) {
                $data .= 'AND id LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `role`="2" AND username LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (!empty($_POST["order"])) {
                $data .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
                $data .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
                $data .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $h = mysqli_query($connect, $data);
        $rows = mysqli_num_rows($h);
        $l = mysqli_query($connect, "SELECT * FROM `users` WHERE `role`='2'");
        $rowsTotal = mysqli_num_rows($l);

        $datas = [];
        $i = 1;
        while ($v = mysqli_fetch_assoc($h)) {
                $datas[] = [
                        'id' => $i++,
                        'username' => $v['username'],
                        'role' => 'User',
                        'button' => '<td class="text-right">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-more-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item updateData" data-toggle="modal" data-id="' . $v['id'] . '" title="Update" data-target="#updateModal">Edit</a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $v['id'] . '" class="dropdown-item text-danger deleteData">Delete</a>
                            </div>
                        </div>
                    </td>'
                ];
        }
        $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $rows,
                "iTotalDisplayRecords" => $rowsTotal,
                "data" => $datas
        );
        echo json_encode($output);
}

function create_user($data, $role)
{
        global $connect;
        $username = $data['username'];
        $pass = $data['password'];

        $sql = get_rows("SELECT * FROM users WHERE username='" . $username . "'");
        if ($sql == 0) {
                $data = mysqli_query($connect, "INSERT INTO `users` (`username`, `pass`, `role`) VALUES ('" . $username . "','" . $pass . "', " . $role . ")");
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function update_user($data, $role)
{
        global $connect;
        $username = $data['username'];
        $pass = $data['password'];

        $sql = get_rows("SELECT * FROM users WHERE username='" . $username . "'");
        if ($sql == 0) {
                $data = mysqli_query($connect, "UPDATE `users` SET `username`='" . $username . "', `pass`='" . $pass . "', `role`=" . $role . " WHERE id='" . $data['id'] . "'");
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function deletes($data, $del)
{
        global $connect;
        $data = mysqli_query($connect, "DELETE FROM $del WHERE id=" . $data . "");
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function deletes_pesanan($data, $del)
{
        global $connect;
        $data = mysqli_query($connect, "DELETE FROM $del WHERE id_booking=" . $data . "");
        // var_dump($data);
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function show_admin()
{
        global $connect;
        $data = "SELECT * FROM `users` WHERE `role`='1' ";
        if (!empty($_POST["search"]["value"])) {
                $data .= 'AND id LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `role`="1" AND username LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (!empty($_POST["order"])) {
                $data .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
                $data .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
                $data .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $h = mysqli_query($connect, $data);
        $rows = mysqli_num_rows($h);
        $l = mysqli_query($connect, "SELECT * FROM `users` WHERE `role`='1'");
        $rowsTotal = mysqli_num_rows($l);

        $datas = [];
        $i = 1;

        while ($v = mysqli_fetch_assoc($h)) {
                $datas[] = [
                        'id' => $i++,
                        'username' => $v['username'],
                        'role' => 'Admin',
                        'button' => '<td class="text-right">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-more-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item updateData" data-toggle="modal" data-id="' . $v['id'] . '" title="Update" data-target="#updateModal">Edit</a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $v['id'] . '" class="dropdown-item text-danger deleteData">Delete</a>
                            </div>
                        </div>
                    </td>'
                ];
        }
        $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $rows,
                "iTotalDisplayRecords" => $rowsTotal,
                "data" => $datas
        );
        echo json_encode($output);
}

function show_paket()
{
        global $connect;
        $data = "SELECT * FROM `paket` ";
        if (!empty($_POST["search"]["value"])) {
                $data .= 'WHERE `nama` LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `harga` LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `menu` LIKE "%' . $_POST["search"]["value"] . '%" ';
        }
        if (!empty($_POST["order"])) {
                $data .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
                $data .= 'ORDER BY id DESC ';
        }
        if ($_POST["length"] != -1) {
                $data .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $h = mysqli_query($connect, $data);
        $rows = mysqli_num_rows($h);
        $l = mysqli_query($connect, "SELECT * FROM `paket` ");
        $rowsTotal = mysqli_num_rows($l);

        $datas = [];
        $i = 1;
        while ($v = mysqli_fetch_assoc($h)) {
                $datas[] = [
                        'id' => $i++,
                        'nama' => $v['nama'],
                        'harga' => $v['harga'],
                        'menu' => $v['menu'],
                        'gambar' => "<figure class='avatar avatar-lg mr-2'>
                        <img src='image/" . $v['gambar'] . "' class='rounded' alt='avatar'>
                       </figure>",
                        'status' => $v['status'],
                        'button' => '<td class="text-right">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-more-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item updateData" data-toggle="modal" data-id="' . $v['id'] . '" title="Update" data-target="#updateModal">Edit</a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $v['id'] . '" class="dropdown-item text-danger deleteData">Delete</a>
                            </div>
                        </div>
                    </td>'
                ];
        }

        $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $rows,
                "iTotalDisplayRecords" => $rowsTotal,
                "data" => $datas
        );
        echo json_encode($output);
}

function byId($data, $table)
{
        $data = query("SELECT * FROM $table WHERE `id`=" . $data['id'] . "");
        echo json_encode($data);
}

function byIdForPesanan($data, $table)
{
        $data = query("SELECT * FROM $table WHERE `id_booking`=" . $data['id'] . "");
        echo json_encode($data);
}

function create_paket($data, $file)
{
        global $connect;
        $nama = $data['nama'];
        $harga = $data['harga'];
        $menu = $data['menu'];
        $status = $data['status'];
        $filename = date('Y-m-d') . mt_rand();
        $tempname =  $file["tmp_name"];
        $folder = "image/" . $filename;

        $sql = get_rows("SELECT * FROM `paket` WHERE nama='" . $nama . "'");
        if ($sql == 0) {
                $data = mysqli_query($connect, "INSERT INTO `paket` (`nama`, `harga`, `menu`, `gambar`,`status`) VALUES ('" . $nama . "','" . $harga . "','" . $menu . "','" . $filename . "','" . $status . "')");

                if (move_uploaded_file($tempname, $folder)) {
                        return json_encode(array('success' => 1));
                }
                return json_encode(array('success' => 0));
        } else {
                return json_encode(array('success' => 2));
        }
}

function update_paket($data, $file)
{
        global $connect;
        $nama = $data['nama'];
        $harga = $data['harga'];
        $menu = $data['menu'];
        $status = $data['status'];
        $filename = date('Y-m-d') . mt_rand();
        $tempname =  $file["tmp_name"];
        $folder = "image/" . $filename;

        $sql = get_rows("SELECT * FROM `paket` WHERE nama='" . $nama . "'");
        if ($sql >= 0) {
                $data = mysqli_query($connect, "UPDATE `paket` SET `nama`='" . $nama . "', `harga`='" . $harga . "', `menu`='" . $menu . "',`gambar`='" . $filename . "',`status`='" . $status . "' WHERE id=" . $data['id'] . "");

                if (move_uploaded_file($tempname, $folder)) {
                        return json_encode(array('success' => 1));
                }

                return json_encode(array('success' => 0));
        } else {
                return json_encode(array('success' => 2));
        }
}

function show_pesanan()
{
        global $connect;
        $data = "SELECT `pesanan`.* , `users`.`username`, `paket`.`nama` FROM `pesanan` LEFT JOIN `users` ON `users`.`id`=`pesanan`.`id_users` LEFT JOIN `paket` ON `paket`.`id`=`pesanan`.`id_paket`  ";
        if (!empty($_POST["search"]["value"])) {
                $data .= 'WHERE `users`.`username` LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `paket`.`nama` LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `pesanan`.`tgl_pesanan` LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (!empty($_POST["order"])) {
                $data .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
                $data .= 'ORDER BY id_booking DESC ';
        }
        if ($_POST["length"] != -1) {
                $data .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $h = mysqli_query($connect, $data);
        $rows = mysqli_num_rows($h);
        $l = mysqli_query($connect, "SELECT `pesanan`.* , `users`.`username`, `paket`.`nama` FROM `pesanan` LEFT JOIN `users` ON `users`.`id`=`pesanan`.`id_users` LEFT JOIN `paket` ON `paket`.`id`=`pesanan`.`id_paket`");
        $rowsTotal = mysqli_num_rows($l);

        $datas = [];
        $i = 1;
        while ($v = mysqli_fetch_assoc($h)) {
                $datas[] = [
                        'id' => $i++,
                        'username' => $v['username'],
                        'nama' => $v['nama'],
                        'tgl_pesanan' => $v['tgl_pesanan'],
                        'tgl_kirim' => $v['tgl_kirim'],
                        'jumlah' => $v['jumlah'],
                        'total_harga' => $v['total_harga'],
                        'bukti' => "<a href='bukti/" . $v['bukti'] . "'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#baruModal'>
                        Lihat
                    </button></a>",
                        'status_pembayaran' => $v['status_pembayaran'],
                        'status_proses' => $v['status_proses'],
                        'button' => '<td class="text-right">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-more-alt"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" class="dropdown-item updateData" data-toggle="modal" data-id="' . $v['id_booking'] . '" title="Update" data-target="#updateModal">Edit</a>
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $v['id_booking'] . '" class="dropdown-item text-danger deleteData">Delete</a>
                            </div>
                        </div>
                    </td>'
                ];
        }

        $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $rows,
                "iTotalDisplayRecords" => $rowsTotal,
                "data" => $datas
        );
        echo json_encode($output);
}

function create_Pesanan($data)
{
        global $connect;
        $pelanggan = $data['pelanggan'];
        $paket = $data['paket'];
        $jumlah = $data['jumlah'];
        $total = $data['total'];
        $bukti = $data['bukti'];
        $pembayaran = $data['pembayaran'];
        $proses = $data['proses'];

        $in = strtotime($data['tglPesanan']);
        $in = date('Y-m-d H:i:s', $in);
        $out = strtotime($data['tglKirim']);
        $out = date('Y-m-d H:i:s', $out);

        $data = mysqli_query($connect, "INSERT INTO `pesanan` (`id_users`, `id_paket`, `tgl_pesanan`, `tgl_kirim`, `jumlah`, `total_harga`, `bukti`, `status_pembayaran`, `status_proses`) VALUES (" . $pelanggan . "," . $paket . ", '" . $in . "', '" . $out . "','" . $jumlah . "','" . $total . "','" . $bukti . "','" . $pembayaran . "','" . $proses . "')");
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function create_Pesanan_User($data)
{
        global $connect;
        $user = $data['user'];
        $paket = $data['paket'];
        $jumlah = $data['jumlah'];
        var_dump($data);

        $data = mysqli_query($connect, "INSERT INTO `keranjang` (`user_id`, `paket_id`, `jumlah`) VALUES (" . $user . "," . $paket . "," . $jumlah . ")");

        $data = query("SELECT * FROM `paket` WHERE id=" . $paket . "");

        $total = $jumlah * $data['harga'];

        $data = mysqli_query($connect, "INSERT INTO `pesanan` (`id_users`, `id_paket`, `tgl_pesanan`, `jumlah`, `total`, `status_pembayaran`, `status_proses`) VALUES (" . $user . "," . $paket . ", '" . date('Y-m-d H:i:s') . "','" . $jumlah . "','" . $total . "','Pending','Pending')");
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function create_Confirm_User($data, $file)
{
        global $connect;
        $user = $data['user'];
        $paket = $data['paket'];

        $filename = date('Y-m-d') . mt_rand();
        $tempname =  $file["tmp_name"];
        $folder = "bukti/" . $filename;

        $data = mysqli_query($connect, "UPDATE `pesanan` SET `tgl_kirim`='" . date('Y-m-d H:i:s') . "', `bukti`='" . $filename . "', `status_pembayaran`='Selesai', `status_proses`='Telah Dikirimkan' WHERE id_users=" . $user . "");
        if ($data) {
                if (move_uploaded_file($tempname, $folder)) {
                        return json_encode(array('success' => 1));
                }
                return json_encode(array('success' => 2));
        } else {
                return json_encode(array('success' => 2));
        }
}

function update_Pesanan($data)
{
        global $connect;
        $pelanggan = $data['pelanggan'];
        $paket = $data['paket'];
        $jumlah = $data['jumlah'];
        $total = $data['total'];
        $bukti = $data['bukti'];
        $pembayaran = $data['pembayaran'];
        $proses = $data['proses'];

        $in = strtotime($data['tglPesanan']);
        $in = date('Y-m-d H:i:s', $in);
        $out = strtotime($data['tglKirim']);
        $out = date('Y-m-d H:i:s', $out);
        // var_dump($data);
        $data = mysqli_query($connect, "UPDATE `pesanan` SET 
        `id_users`=" . $pelanggan . ", 
        `id_paket`=" . $paket . ", 
        `tgl_pesanan`='" . $in . "', 
        `tgl_kirim`='" . $out . "', 
        `jumlah`=" . $jumlah . ",
        `total_harga`=" . $total . ",
        `bukti`='" . $bukti . "',
        `status_pembayaran`='" . $pembayaran . "',
        `status_proses`='" . $proses . "'  
        WHERE id_booking=" . $data['id_booking'] . "");
    
        
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}


function profile_setting()
{
        global $connect;
        $mu = get_rows("SELECT * FROM `users` WHERE username='" . $_POST['username'] . "' AND email='" . $_POST['email'] . "'");
        if ($mu == 0) {
                mysqli_query($connect, "UPDATE `users` SET `username`='" . $_POST['username'] . "', `email`='" . $_POST['email'] . "' WHERE id=" . $_POST['id'] . "");
                session_start();
                $_SESSION['username'] = $_POST['username'];
                return json_encode(array('success' => 1));
        }

        return json_encode(array('success' => 2));
}

function password_setting()
{
        global $connect;
        mysqli_query($connect, "UPDATE `users` SET `pass`='" . $_POST['password1'] . "' WHERE id=" . $_POST['id'] . "");
        return json_encode(array('success' => 1));
}

function show_history()
{
        global $connect;
        session_start();
        $data = "SELECT `pesanan`.* , `paket`.`nama` FROM `pesanan` LEFT JOIN `paket` ON `paket`.`id`=`pesanan`.`id_paket` WHERE `pesanan`.`id_users`=" . $_SESSION['i'] . " ";
        if (!empty($_POST["search"]["value"])) {
                $data .= 'WHERE `paket`.`nama` LIKE "%' . $_POST["search"]["value"] . '%" ';
                $data .= 'OR `pesanan`.`tgl_pesanan` LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (!empty($_POST["order"])) {
                $data .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
                $data .= 'ORDER BY id_pesanan DESC ';
        }
        if ($_POST["length"] != -1) {
                $data .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        $h = mysqli_query($connect, $data);
        $rows = mysqli_num_rows($h);
        $l = mysqli_query($connect, "SELECT `pesanan`.* , `paket`.`nama` FROM `pesanan` LEFT JOIN `paket` ON `paket`.`id`=`pesanan`.`id_paket` WHERE `pesanan`.`id_users`=" . $_SESSION['i'] . "");
        $rowsTotal = mysqli_num_rows($l);

        $datas = [];
        $i = 1;

        while ($v = mysqli_fetch_assoc($h)) {
                $datas[] = [
                        'id' => $i++,
                        'nama' => $v['nama'],
                        'tgl_pesanan' => $v['tgl_pesanan'],
                        'tgl_kirim' => $v['tgl_kirim'],
                        'jml' => $v['jml'],
                        'total' => $v['total'],
                        'sts_proses' => $v['sts_proses'],
                        'button' => $v['sts_proses'] == 'Selesai' || $v['sts_proses'] == 'Failed' ? '<td class="text-right">
                        <a href="#" class="dropdown-item text-success">Sukses</a>
            </td>' : '<td class="text-right">
                                <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $v['id_pesanan'] . '" class="dropdown-item text-danger deleteData">Batalkan</a>
                    </td>'
                ];
        }

        $output = array(
                "draw" => intval($_POST["draw"]),
                "iTotalRecords" => $rows,
                "iTotalDisplayRecords" => $rowsTotal,
                "data" => $datas
        );
        echo json_encode($output);
}

function cart_add($data)
{
        global $connect;
        $id = $data['id'];
        $jumlah = (int)$data['jumlah']+1;
        $data = mysqli_query($connect, "UPDATE `keranjang` SET `jumlah`='" . $jumlah . "' WHERE paket_id=" . $id . ""); 
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}

function cart_delete($data)
{
        global $connect;
        $id = $data['id'];
        $jumlah = (int)$data['jumlah'];
        if($jumlah<=1){
                $data = mysqli_query($connect, "DELETE FROM `keranjang` WHERE paket_id=" . $id . "");
        }else{
                $jumlah = $jumlah-1;

                $data = mysqli_query($connect, "UPDATE `keranjang` SET `jumlah`='" . $jumlah . "' WHERE paket_id=" . $id . ""); 
        }
        if ($data) {
                return json_encode(array('success' => 1));
        } else {
                return json_encode(array('success' => 2));
        }
}


function checkout(){
        global $connect;
        session_start();
        $data = get_data("SELECT * FROM `keranjang` WHERE `user_id`=" . $_SESSION['i'] . "");
        foreach($data as $v){
                $harga = query("SELECT harga FROM `paket` WHERE id=" . $v['paket_id'] . "");
                $total = $v['jumlah'] * $harga['harga'];
                $data = mysqli_query($connect, "INSERT INTO `pesanan` (`id_users`, `id_paket`, `jumlah`, `total_harga`, `tgl_pesanan`, `tgl_kirim`, `status_proses`) VALUES (" . $_SESSION['i'] . ", " . $v['paket_id'] . ", " . $v['jumlah'] . ", " . $total . ", '" . date('Y-m-d') . "', '" . date('Y-m-d', strtotime('+3 days')) . "', 'Pending')");
                mysqli_query($connect, "DELETE FROM `keranjang` WHERE `user_id`=" . $_SESSION['i'] . " AND `paket_id`=" . $v['paket_id'] . "");
        }
        if ($data) {
                return header('location: confirm.php?v=' . $v['paket_id'] . '');;
        } else {
                return json_encode(array('success' => 2));
        }
}

function metode()
{
        $data = get_data("SELECT * FROM paket");
        $datas = [];
        $kriteriaMinC1 = 0;
        $kriteriC2 = [];
        $kriteriaMinC2 = 0;
        $hasilK1=[];
        $hasilK2=[];
        $kriteriaMinC1 = $data[0]['harga'];
        foreach($data as $v){
                $kriteriaMinC1 =  $v['harga'] < $kriteriaMinC1 ? $v['harga'] : $kriteriaMinC1;
        }
        foreach($data as $v){
                $jum = count(explode(', ', $v['menu']));
                array_push($kriteriC2, $jum);
                $d =[
                        'menu' => $jum,
                        'harga' => $v['harga']
                ];
                array_push($datas, $d);
        }
        $kriteriaMinC2 = $kriteriC2[0];
        for($i=0; $i<count($kriteriC2);$i++){
                $kriteriaMinC2 =  $kriteriaMinC2 < $kriteriC2[$i] ? $kriteriaMinC2 : $kriteriC2[$i];
        }

        for($i=0; $i<count($data);$i++){
                array_push($hasilK1, $kriteriaMinC1/$data[$i]['harga']);
                array_push($hasilK2, $kriteriaMinC2/$kriteriC2[$i]);
        }

        $kriteriaMaxC1 = $hasilK1[0];
        $kriteriaMaxC2 = $hasilK2[0];
        for($i=0; $i<count($hasilK1);$i++){
                $kriteriaMaxC1 =  $kriteriaMaxC1 > $hasilK1[$i] ? $kriteriaMaxC1 : $hasilK1[$i];
                $kriteriaMaxC2 =  $kriteriaMaxC2 > $hasilK2[$i] ? $kriteriaMaxC2 : $hasilK2[$i];
        }

        $hasilK11 = [];
        $hasilK22 = [];
        for($i=0; $i<count($hasilK1);$i++){
                array_push($hasilK11, $hasilK1[$i]/$kriteriaMaxC1);
                array_push($hasilK22, $hasilK2[$i]/$kriteriaMaxC2);
        }

        $akhir = [];
        for($i=0; $i<count($data);$i++){
                $v = [
                        'name'=>$data[$i]['nama'],
                        'rank'=>$hasilK1[$i]+$hasilK2[$i]
                ];
                array_push($akhir, $v);
        }
        
        return $akhir;
}