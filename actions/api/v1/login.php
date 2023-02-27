<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

// validation here
Validation::run([
    'username' => [
        'required'
    ],
    'password' => [
        'required'
    ],
], $_POST, 'json');

$conn  = conn();
$db    = new Database($conn);

$user  = $db->single('users',[
    'username' => $_POST['username'],
    'password' => md5($_POST['password']),
    'status'   => 'AKTIF'
]);

if($user)
{
    // generate token
    $token = bin2hex(random_bytes(64));
    $expired_at = date('Y-m-d H:i:s', strtotime('+4 hour'));
    $user  = $db->update(['auth_token'=>$token, 'token_expired_at' => $expired_at],['id' => $user->id]);

    echo json_encode([
        'success' => true,
        'message' => 'Login Berhasil',
        'data'    => $token
    ]);
    die();
}

http_response_code(404);
echo json_encode([
    'success' => false,
    'message' => 'Login Gagal! Username atau Password tidak valid'
]);
die();