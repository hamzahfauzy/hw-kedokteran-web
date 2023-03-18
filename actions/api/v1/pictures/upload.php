<?php

if(request() != 'POST')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

// validation here
Validation::run([
    'file' => [
        'required','file','mime:jpg,jpeg,png'
    ]
], $_FILES, 'json');

$conn  = conn();
$db    = new Database($conn);
$user  = ApiUser::getUser();

$file = do_upload($_FILES['file'],'uploads');

$db->insert('pictures',[
    'user_id' => $user->id,
    'file'    => $file
]);

$db->insert('logs',[
    'user_id' => $user->id,
    'description' => 'Mengupload gambar '.asset($file)
]);

echo json_encode([
    'success' => true,
    'message' => 'Gambar berhasil di upload'
]);
die();