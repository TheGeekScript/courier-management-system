<?php  
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Asia/Kolkata');
session_start();
ob_start();

$serverName = "localhost";
$databaseName = "omega"; 
$username = "root"; 
$password = ""; 

try {
	$db = new PDO("mysql:host={$serverName};dbname={$databaseName}", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
} catch (PDOException $e){
	return 'connection error '. $e->getMessage();
}	

if (!empty($_SESSION['session'])) {
    $users = $db -> query("SELECT * FROM master_admin WHERE master_id = '".$_SESSION['master_id']."'")->fetch();
} else {}