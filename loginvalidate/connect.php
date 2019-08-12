<?php
// sql database connection
// mysql_connect("localhost","root","");

// database connection of hostinger 
// $conn = mysqli_connect("mysql.hostinger.in", "u564985442_kal", "kalyan123");
// mysqli_select_db($conn,'u564985442_kal');
// end of hostinger connection

$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn,'pcview');
?>