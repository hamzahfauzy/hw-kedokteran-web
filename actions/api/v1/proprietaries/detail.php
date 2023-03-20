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
        'required','exists:proprietaries,id,'.$id.',user_id,'.$user->id
    ],
], $_GET, 'json');

$conn  = conn();
$db    = new Database($conn);

$data = $db->single('proprietaries',[
    'id'      => $id,
    'user_id' => $user->id,
    'expired_at' => ['>', date('Y-m-d H:i:s')]
]);

$data->category = json_decode($data->category);
$data->questions = json_decode($data->questions);
foreach($data->questions as $question)
{
    if(!isset($question->answer))
    {
        $question->answer = '';
    }
}

echo json_encode([
    'success' => true,
    'message' => 'Detail proprietaries',
    'data'    => $data
]);
die();