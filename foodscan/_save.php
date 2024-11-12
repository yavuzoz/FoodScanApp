<?php
require_once 'inc/init.php';
$_POST['prod_user_id'] = $_SESSION['user_id'];

if (isset($_POST['prod_barcode']) && isset($_POST['prod_name'])) {
    if ($_POST['prod_id']) {
        $id = escape($_POST['prod_id']);
        $update = $db->Update("prod", postToUpdateQ($_POST), "prod_id='$id'");
        if ($update) {
            $success = url . "/edit.php?prod_id=" . $id . "&msg_s=1";
        } else {
            $success = url . "/edit.php?prod_id=" . $id . "&msg_f=1";
        }
        echo "<script>window.location='$success';</script>";
    } else {
        $_POST['prod_id'] = null;
        $q_ = postToInsertQ($_POST, 'prod');
        $insert = $db->Insert("prod", $q_['val_'], $q_['key_']);
        if ($insert) {
            $success = url . "/list.php?msg_s=1";
        } else {
            $success = url . "/list.php?msg_f=1";
        }
        echo "<script>window.location='$success';</script>";
    }
} else {
    header("Location: list.php?msg_s=" . urlencode("Missing Product Data!"));

}

?>
