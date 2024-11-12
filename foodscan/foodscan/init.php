<?php
require_once("conn.php");
require_once("function.php");
session_start();
//error_reporting(E_ALL);
ini_set('display_errors', 'On');


$db = new Db();
$mysqli = Db::$_mysqli;

if ($_SESSION['username']) {
    $user = [
        'username' => $_SESSION['username'],
        'name' => $_SESSION['name'],
        'type' => $_SESSION['user_type'],
        'status' => true,
        'id' => $_SESSION['user_id']
    ];
}
?>