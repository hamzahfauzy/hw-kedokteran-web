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

$db->query = "SELECT * FROM categories WHERE id NOT IN (SELECT category_id FROM proprietaries WHERE user_id = $user->id AND expired_at > ".date('Y-m-d H:i:s').")";
$data = $db->exec('all');

echo json_encode([
    'success' => true,
    'message' => 'List categories',
    'data'    => $categories
]);
die();