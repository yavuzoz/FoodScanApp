<?php
require_once 'inc/init.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    if(!isset($_SESSION))
    {
        session_start();
    }
    $username = stripslashes($_REQUEST['username']); // removes backslashes
    $username = mysqli_real_escape_string($db::$_mysqli, $username); //escapes special characters in a string
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($db::$_mysqli, $password);
    $query = "SELECT * FROM `user` WHERE user_uname='$username' and user_password='" . $password . "' and user_status = 'a'";
    $result = mysqli_query($db::$_mysqli, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $_SESSION['username'] = $username;
        $user = $db->Fetch("*", "user", "user_uname='$username'");
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['user_id'] = $user['user_id'];
        $success = url."/list.php";
        echo "<script>window.location='$success';</script>";
        exit;
    } else {
        header("Location: index.php?msg_f=".urlencode("User Not Found !"));
    }
}

?>
