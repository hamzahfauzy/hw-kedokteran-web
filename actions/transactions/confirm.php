<?php

if(request() != 'GET')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$conn = conn();
$db   = new Database($conn);

$user  = ApiUser::getUser();
$id    = $_GET['id']; // transaction id

$transaction = $db->single('transactions',['id' => $id]);
$category = $db->single('categories',[
    'id' => $transaction->category_id
]);

$db->query = "SELECT * FROM questions WHERE id IN (SELECT question_id FROM category_questions WHERE category_id = $transaction->category_id)";
$questions = $db->exec('all');

$db->insert('proprietaries',[
    'user_id' => $user->id,
    'transaction_id' => $id,
    'category_id' => $category->id,
    'category' => json_encode($category),
    'questions' => json_encode($questions),
    'total_score' => 0,
    'expired_at' => date('Y-m-d',strtotime('+'.$category->active_time.' days'))
]);

$db->update('transactions',['status'=>'confirm'],['id' => $id]);

set_flash_msg(['success'=>'Transaksi berhasil dikonfirmasi']);
header('location:'.routeTo('crud/index',['table'=>'transactions']));
die();