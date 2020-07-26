<?php
// This Framework has created by FIRAT (Ledmago);
// Hello Developer. You can change config in here.


$database_username = "daumuzik_portal";    // Database Username
$database_password = "Ledmago11";    // Database Password
$database_name = "daumuzik_portal";     // Database name
$database_host = "localhost";     // Database Connection Host Adress.

		
try {
   $db = new \PDO("mysql:host=".$database_host.";dbname=".$database_name."", $database_username, $database_password); // Do not touch this line ;
} catch ( PDOException $e ){
die("Your Config information is wrong : ");
}
    


?>