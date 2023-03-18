<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$user  = ApiUser::getUser();
$id    = $_POST['id'];

// validation here
Validation::run([
    'id' => [
        'required','exists:categories,id,'.$id
    ],
], $_POST, 'json');

$conn  = conn();
$db    = new Database($conn);
$category = $db->single('categories',['id'=>$id]);

$data = $db->insert('transactions',[
    'user_id'     => $user->id,
    'category_id' => $id,
    'status'      => 'pending',
    'amount'      => $category->price
]);

$db->insert('logs',[
    'user_id' => $user->id,
    'description' => 'Membeli kategori '.$category->name.' (pending)'
]);

echo json_encode([
    'success' => true,
    'message' => 'Pembelian Berhasil. Silahkan lanjutkan ke pembayaran'
]);
die();