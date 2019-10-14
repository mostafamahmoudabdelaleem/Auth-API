<?php

require_once '../models/user.php';


$result = '';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Origin, Content-Type, Api-Key");


if(isset($_SERVER['HTTP_API_KEY']) && $_SERVER['HTTP_API_KEY'] == 111111){

    $data = json_decode(file_get_contents("php://input"));
    if(isset($data->username) && isset($data->password) && isset($data->email)){

        $username = $data->username;
        $email = $data->email;
        $password = $data->password;

        $user_handler = new UserHandler();
        $user_data = $user_handler->register($username, $password, $email);
        
        if($user_data == 1){
            $result = array(
                'msg' => "Account created successfully",
                'code' => 200
            );
        }else{
            $result = array(
                'msg' => "Registration failed",
                'code' => 401
            );
        }
    }else{
        $result = array(
            'msg' => "Bad Request",
            'code' => 403
        );
    }
}else{
    $result = array(
        'msg' => "Bad Authentications",
        'code' => 402
    );
}

echo json_encode($result);
