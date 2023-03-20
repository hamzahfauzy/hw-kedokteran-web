<?php

if(request() != 'GET')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$user  = ApiUser::getUser();
$id    = $_GET['id'];

// validation here
Validation::run([
    'id' => [
        'required','exists:transactions,id,'.$id.',user_id,'.$user->id
    ],
], $_GET, 'json');

$conn  = conn();
$db    = new Database($conn);

$data = $db->single('transactions',[
    'id'      => $id,
    'user_id' => $user->id
]);

$data->file_url = asset($data->file);

$data->category = $db->single('categories',['id' => $data->category_id]);

echo json_encode([
    'success' => true,
    'message' => 'Detail transaksi',
    'data'    => $data
]);
die();