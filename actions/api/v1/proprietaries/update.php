<?php

if(request() != 'POST')
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
    'questions' => [
        'required'
    ]
], array_merge($_POST, $_GET), 'json');

$conn  = conn();
$db    = new Database($conn);

$data = $db->update('proprietaries',[
    'questions' => json_encode($_POST['questions'])
],[
    'id' => $id
]);

$data->category = json_decode($data->category);
$data->questions = json_decode($data->questions);

echo json_encode([
    'success' => true,
    'message' => 'Detail proprietaries',
    'data'    => $data
]);
die();