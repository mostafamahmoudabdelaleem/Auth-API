<?php

require_once '../models/user.php';


$result = '';
header('Content-Type: application/json');

if(isset($_SERVER['HTTP_API_KEY']) && $_SERVER['HTTP_API_KEY'] == 111111){

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user_handler = new UserHandler();
        $user_data = $user_handler->loginByUsername($username, $password);
        
        if($user_data !== null){
            $user_data = $user_data->fetch_assoc();
            $result = array(
                'userdata'  => $user_data,
                'msg' => "Login successfully",
                'code' => 200
            );
        }else{
            $result = array(
                'msg' => "Login failed",
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
