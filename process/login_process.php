<?php 
echo $username = $_POST['username'];
echo "<br>";
echo $password_input = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
echo "<br>";
echo $password_hash;
?>