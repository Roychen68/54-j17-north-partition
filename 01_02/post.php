<?php
include "db.php";
$pdo->query("INSERT INTO `tickets`(`firstname`, `lastname`, `password`, `phone`) VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['password']}','{$_POST['phone']}')")
?>