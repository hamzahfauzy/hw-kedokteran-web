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

$data = $db->all('proprietaries',[
    'user_id' => $user->id,
    'expired_at' => ['>', date('Y-m-d H:i:s')]
],['id' => 'DESC']);

$data = array_map(function($d) use ($db) {
    $d->category = json_decode($d->category);
    $d->questions = json_decode($d->questions);
    foreach($d->questions as $question)
    {
        if(!isset($question->answer))
        {
            $question->answer = '';
        }
    }
    return $d;
}, $data);

echo json_encode([
    'success' => true,
    'message' => 'List proprietaries',
    'data'    => $data
]);
die();