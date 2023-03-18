<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$user  = ApiUser::getUser();
$id    = $_GET['id'];

$data = $_GET;
$params = [
    'id' => [
        'required','exists:transactions,id,'.$id.',user_id,'.$user->id
    ],
];
if(isset($_FILES['file']) && !empty($_FILES['file']['name']))
{
    $data['file'] = $_FILES['file'];
    $params['file'] = [
        'file','required','mime:jpeg,jpg,png'
    ];
}

// validation here
Validation::run($params, $data, 'json');

$conn  = conn();
$db    = new Database($conn);

$updateData = [
    'status' => 'payment'
];
if(isset($_FILES['file']) && !empty($_FILES['file']['name']))
{
    $updateData['file'] = do_upload($_FILES['file'],'uploads');
}

$data = $db->update('transactions',$updateData,[
    'id' => $id
]);

echo json_encode([
    'success' => true,
    'message' => 'Transaksi berhasil di update',
    'data'    => $data
]);
die();