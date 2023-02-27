<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

// validation here
Validation::run([
    'phone' => [
        'required','exists:users,phone,'.$_POST['phone']
    ],
], $_POST, 'json');

$conn  = conn();
$db    = new Database($conn);

$user = $db->single('users',['phone'=>$_POST['phone']]);
$new_password = substr(md5(rand(1111,9999)),0,8);
$db->update('users',[
    'password' => md5($new_password)
],[
    'id' => $user->id
]);
// notif here

echo json_encode([
    'success' => true,
    'message' => 'Reset password berhasil. Silahkan cek whatsapp anda untuk mendapatkan password terbaru',
]);
die();