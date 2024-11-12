<?php
session_start();
$_SESSION['user_status'] = false;
unset($_SESSION['username']);
if (session_destroy()) {
    header("Location: index.php");
}
?>