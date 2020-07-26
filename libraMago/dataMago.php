<?php
require("config.php");
try {
     $db = new \PDO("mysql:host=".$database_host.";dbname=".$database_name."", $database_username, $database_password);
} catch ( PDOException $e ){
     die("Your database config is wrong. Please, change config informations.");
}
?>