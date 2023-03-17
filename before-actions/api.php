<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
// Specify domains from which requests are allowed
// header('Access-Control-Allow-Origin: *');

// Specify which request methods are allowed
// header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

// Additional headers which may be sent along with the CORS request
// header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

// Set the age to 1 day to improve speed/caching.
// header('Access-Control-Max-Age: 86400');

header("Content-Type: application/json");

if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    exit();
}

$isApiV1 = startWith($route, 'api/v1/');
$nonAuthRoute = !in_array($route,[
    'api/v1/reset-password',
    'api/v1/register',
    'api/v1/login',
    'api/v1/slide-show'
]);

if($isApiV1 && $nonAuthRoute)
{
    // check if token is sent
    $token = getBearerToken();
    if(!$token)
    {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Api key is required'
        ]);
        die();
    }

    // check if user exists in token
    $conn  = conn();
    $db    = new Database($conn);

    $token = trim($token);
    $user  = $db->single('users',['auth_token' => $token, 'status' => 'AKTIF']);
    if(empty($user))
    {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Api key is not valid'
        ]);
        die();
    }

    // check if token is not expired
    $now = strtotime('now');
    if(strtotime($user->token_expired_at) < $now)
    {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Api key is expired'
        ]);
        die();
    }

    ApiUser::setUser($user);
}

return true;