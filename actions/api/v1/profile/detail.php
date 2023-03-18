<?php

if(request() != 'GET')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$user  = ApiUser::getUser();
$user->pic_url = asset($user->pic_url);

echo json_encode([
    'success' => true,
    'message' => 'Profile berhasil di ambil',
    'data'    => $user
]);

die();