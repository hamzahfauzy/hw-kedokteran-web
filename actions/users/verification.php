<?php

$conn = conn();
$db   = new Database($conn);

$db->update('users',['status'=>'AKTIF'],[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pengguna berhasil diverifikasi']);
header('location:'.routeTo('users/index'));
die();