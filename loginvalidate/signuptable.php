<!-- signup table.php -->

<?php

$pwd = $_REQUEST['pwd'];
$email = $_REQUEST['email'];
include_once 'connect.php';

	$username = explode("@", $email);
	mysqli_query($conn,"INSERT INTO logintable(username,password,email) VALUES('$username[0]','$pwd','$email')");
	// mysqli_query($conn,"UPDATE logintable SET password = '$pwd' WHERE email = '$email'");
	mysqli_query($conn,"UPDATE verify SET id = '1' WHERE email = '$email'");

	echo "Registration is done , Login into your account and use our website";

?>