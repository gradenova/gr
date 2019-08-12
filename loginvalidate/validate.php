
<?php
session_start();

$name = $pass = $error = "";
// if($_SERVER["REQUEST_METHOD"] == "POST")
// {
    include_once 'connect.php';
    $name = $_REQUEST["name"];
    $pass = $_REQUEST["pass"];

    $query = mysqli_query($conn,"SELECT * FROM logintable where email = '$name' and password = '$pass'");
    $numrow = mysqli_num_rows($query);
    if($numrow == 1)
    {
        while($row = mysqli_fetch_assoc($query))
        {
            $_SESSION['username'] = $name;
        }
        echo '1';
        // header("location:profile.php");
    }
    else
    {
        echo '2';
    }


// }

?>