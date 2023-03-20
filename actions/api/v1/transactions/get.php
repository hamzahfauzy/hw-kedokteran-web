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

$data = $db->all('transactions',[
    'user_id' => $user->id
],['id' => 'DESC']);

$data = array_map(function($d) use ($db) {
    $d->category = $db->single('categories',['id' => $d->category_id]);
    $d->file_url = asset($d->file);
    return $d;
}, $data);

echo json_encode([
    'success' => true,
    'message' => 'List transaksi',
    'data'    => $data
]);
die();