<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$data = $_POST;
$params = [
    'name' => [
        'required'
    ],
    // 'username' => [
    //     'required','unique:users'
    // ],
    'address' => [
        'required'
    ],
    'phone' => [
        'required'
    ],
];
if(isset($_FILES['pic_url']) && !empty($_FILES['pic_url']['name']))
{
    $data['pic_url'] = $_FILES['pic_url'];
    $params['pic_url'] = [
        'file','required','mime:jpeg,jpg,png'
    ];
}

// validation here
Validation::run($params, $data, 'json');

$conn  = conn();
$db    = new Database($conn);
$user  = ApiUser::getUser();

if(isset($_FILES['pic_url']) && !empty($_FILES['pic_url']['name']))
{
    $_POST['pic_url'] = do_upload($_FILES['pic_url'],'uploads');
}

if(isset($_POST['password']) && !empty($_POST['password']))
{
    $_POST['password'] = md5($_POST['password']);
}

$user = $db->update('users',$_POST,[
    'id' => $user->id
]);

echo json_encode([
    'success' => true,
    'message' => 'Profile berhasil di update',
    'data'    => $user
]);
die();