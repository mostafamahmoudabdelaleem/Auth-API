<?php

require_once __DIR__ . '/Database.php';

$db_handler = DatabaseHandler::getInstance();
$page_title = "DumpDB";


$dump_users = "INSERT INTO `auth_users` 
        (`id`, `username`, `email`, `password`, `verified`, `created_at`, `verified_at`) 
        VALUES 
        (1, 'admin', 'admin@mail.com', '21232f297a57a5a743894a0e4a801fc3', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
        (2, 'moderator', 'moderator@mail.com', '21232f297a57a5a743894a0e4a801fc3', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
        (3, 'user', 'user@mail.com', 'e10adc3949ba59abbe56e057f20f883e', '0', CURRENT_TIMESTAMP, NULL);
";

$db_handler->connect();
$result = $db_handler->execute_query($dump_users);
$db_handler->disconnect();

if($result === "ERR"){

    $msg = "Database already dumped before.";
    $emoji = ":(";
    $msg_header = "Failed";

}else if($result == 1){
    
    $msg = "Database dumped successfully.";
    $emoji = ":)";
    $msg_header = "Successed";

}else{
    
    $msg = "Unknown error.";
    $emoji = ":(";
    $msg_header = "Failed";

}

require __DIR__ . '/errorPage.php';

?>


