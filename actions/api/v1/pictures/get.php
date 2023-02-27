<?php

if(request() != 'GET')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$conn  = conn();
$db    = new Database($conn);
$user  = ApiUser::getUser();

$data = $db->all('pictures',[
    'user_id' => $user->id,
],['id' => 'DESC']);

echo json_encode([
    'success' => true,
    'message' => 'List pictures',
    'data'    => $data
]);
die();