<?php
$pdo = new PDO ("mysql:host=localhost;charset=utf8;dbname=web01","root","");
$pdo->query("INSERT INTO `tickets`(`firstname`, `lastname`, `password`, `phone`) VALUES ('{$_POST['firstname']}','{$_POST['lastname']}','{$_POST['password']}','{$_POST['phone']}')")
?>