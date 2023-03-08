<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

// validation here
Validation::run([
    'name' => [
        'required'
    ],
    'username' => [
        'required','unique:users'
    ],
    'password' => [
        'required'
    ],
    'address' => [
        'required'
    ],
    'phone' => [
        'required'
    ],
    'pic_url' => [
        'file','required','mime:jpeg,jpg,png'
    ],
], array_merge($_POST,$_FILES), 'json');

$conn  = conn();
$db    = new Database($conn);

$_POST['pic_url'] = do_upload($_FILES['pic_url'],'uploads');
$_POST['password'] = md5($_POST['password']);
$db->insert('users',$_POST);

// notif here

echo json_encode([
    'success' => true,
    'message' => 'Pendaftaran berhasil! Data pendaftaran terlebih dahulu akan diverifikasi oleh admin',
]);
die();