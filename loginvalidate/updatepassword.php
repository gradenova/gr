<!-- updatepassword.php -->

<?php

$pwd = $_REQUEST['pwd'];
$email = $_REQUEST['email'];
include_once 'connect.php';

	mysqli_query($conn,"UPDATE logintable SET password = '$pwd' WHERE email = '$email'");
	mysqli_query($conn,"UPDATE fpmail SET id = '1' WHERE email = '$email'");

	echo "Your password is updated successfully";

?>