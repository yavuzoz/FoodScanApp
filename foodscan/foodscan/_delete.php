<?php
require_once 'inc/init.php';

if (isset($_GET['prod_id'])) {
    $id = $_GET['prod_id'];
    $del = $db->Delete("prod", "prod_id='$id'");
    if ($del) {
        $success = url . "/list.php?&msg_s=1";
    } else {
        $success = url . "/list.php?&msg_f=1";
    }

    echo "<script>window.location='$success';</script>";

}