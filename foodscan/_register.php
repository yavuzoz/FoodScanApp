<?php
require_once 'inc/init.php';

if (isset($_POST['user_uname']) && isset($_POST['user_password'])) {
    if(!isset($_SESSION))
    {
        session_start();
    }
    $username = stripslashes($_REQUEST['user_uname']); // removes backslashes
    $username = mysqli_real_escape_string($db::$_mysqli, $username); //escapes special characters in a string

    $query = "SELECT * FROM `user` WHERE user_uname='$username'";
    $result = mysqli_query($db::$_mysqli, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        header("Location: index.php?msg_f=".urlencode("This username is used in the system."));
    } else {
        $q_ = postToInsertQ($_POST, 'user');
        $insert = $db->Insert("user", $q_['val_'], $q_['key_']);
        header("Location: index.php?msg_s=".urlencode("Log in with your information!"));
    }
}

?>
