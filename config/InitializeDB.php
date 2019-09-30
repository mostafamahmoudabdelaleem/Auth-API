<?php

require_once __DIR__ . '/Database.php';

$db_handler = DatabaseHandler::getInstance();
$DBName = $db_handler->getDBName();
$page_title = "InitializeDB";


$create_auth_user_table = "CREATE TABLE `$DBName`.`auth_users` 
        ( 
            `id` INT(255) NOT NULL AUTO_INCREMENT , 
            `username` VARCHAR(32) NOT NULL , 
            `email` VARCHAR(128) NOT NULL , 
            `password` VARCHAR(512) NOT NULL , 
            `verified` BOOLEAN NOT NULL DEFAULT FALSE , 
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
            `verified_at` TIMESTAMP NULL DEFAULT NULL , 
            PRIMARY KEY (`id`),
            UNIQUE(`username`),
            UNIQUE(`email`)
        ) ENGINE = MyISAM;";

$db_handler->connect();
$result = $db_handler->execute_query($create_auth_user_table);
$db_handler->disconnect();

if($result === "ERR"){

    $msg = "Database already initalized before.";
    $emoji = ":(";
    $msg_header = "Failed";

}else if($result == 1){
    
    $msg = "Database initalized successfully.";
    $emoji = ":)";
    $msg_header = "Successed";

}else{
    
    $msg = "Unknown error.";
    $emoji = ":(";
    $msg_header = "Failed";

}

require __DIR__ . '/errorPage.php';

?>


