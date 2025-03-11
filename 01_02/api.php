<?php
include "db.php";

$id = $_POST['id'];
switch ($_POST['action']) {
    case 'post':
        $image = null;
        if (!empty($_FILES['file']['tmp_name'])) {
            $file = file_get_contents($_FILES['file']['tmp_name']);
            $image = base64_encode($file);
        }
        $pdo->query("INSERT INTO `tickets`(`firstname`, `lastname`, `phone`, `password`, `image`) VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['password']}','{$_POST['phone']}','{$image}')")
        break;
    
}
?>