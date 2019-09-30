<?php
require_once '../config/Database.php';
class UserHandler{

    private $db_handler;
    
    // Sets the value of DB handler instance in constructor
	function __construct() {
		$this->db_handler = DatabaseHandler::getInstance();
    }
    
    // $username => the unique identifer of the user
    // $password => the secret word to login of this username
    // $email => the main email of the user
    public function register($username, $password, $email){
        
        //encripting the password so it became secretly stored in the database
        $hashed_password = md5($password);

        $sql = "INSERT INTO `auth_users`
                (`username`, `password`, `email`)
                VALUES 
                ('$username', '$hashed_password', '$email')";
        
        $this->db_handler->connect();
        $response = $this->db_handler->execute_query($sql);
        $this->db_handler->disconnect();

        return $response;

    }

    // $username => the unique identifer of the user
    // $password => the secret word to login of this username
    public function loginByUsername($username, $password){

        //encripting the password so it became secretly stored in the database
        $hashed_password = md5($password);

        $sql = "SELECT * FROM `auth_users` 
                WHERE `username` = '$username' 
                AND `password` = '$hashed_password';";
        
        $this->db_handler->connect();
        $response = $this->db_handler->execute_query($sql);
        $this->db_handler->disconnect();

        return $response;
    }

    // $username => the unique identifer of the user
    public function resetPassword($username){
        //TODO implement reset password method
    }

}