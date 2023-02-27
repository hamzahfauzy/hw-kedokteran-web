<?php

if(request() != 'GET')
{
    http_response_code(405);
    echo json_encode(['success'=>false,'message'=>'Method not allowed']);
    die();
}

$conn  = conn();
$db    = new Database($conn);

$slides = $db->all('slides');
$slides = array_map(function($slide){
    $slide->file_url = routeTo($slide->filename);
    return $slide;
}, $slides);

echo json_encode([
    'success' => true,
    'message' => 'List slide show',
    'data'    => $slides
]);
die();