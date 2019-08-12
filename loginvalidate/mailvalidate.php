
<?php

$message = "";

    include_once 'connect.php';
    $email = $_REQUEST["email"];
    $query = mysqli_query($conn,"SELECT * FROM logintable where email = '$email'");
    $numrow = mysqli_num_rows($query);
    if($numrow == 1)    
    {
        $token = randomString(10);
        mysqli_query($conn,"INSERT INTO fpmail(email,token,id) VALUES('$email','$token','0')");
        resetmail($email,$token);
    }
    else
    {
        echo "Invalid E-mail ID please check your E-mail ID";
    }

    function randomString($length)
        {
            $validCharacters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
            $validNumbers = strlen($validCharacters);
            $result = "";
            for ($i=0; $i < $length ; $i++) 
            { 
                $index = mt_rand(0,$validNumbers-1);
                $result .= $validCharacters[$index];
            }
            return $result;
        }
    function resetmail($to,$tokens)
    {
        $subject = "Smart Grader: Password Reset";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <smartgraderapp@gmail.com>' . "\r\n";
        $uri = 'http://'.$_SERVER['HTTP_HOST'];
        // $header = "From:smartgraderapp@gmail.com";
        // $message = "
        //             <html>
        //             <head>
        //             <title>Password Reset Link</title>
        //             </head>
        //             <body>
        //             <p>Click on the given link to reset your password <a href="$uri/loginvalidate/update.php?token=$tokens\">Reset Password</a></p>
                     
        //             </body>
        //             </html>
        //             ";

        $message="<!DOCTYPE html>
<html>
<head>
    <title>Smart Grader</title>
</head>
<body style=\"border: solid 1px #000;\">
    <div style=\"background-color: #37474f\">
        <img src=\"http://smartgrader.tk/img/footer.png\">
    </div>
<div style=\"padding: 50px;\">
    <h2>Hi&nbsp;&nbsp;&nbsp; Dear User ,</h2>
    <p>Please click below link to reset your account password. <a href=\"$uri/loginvalidate/update.php?token=$tokens\">Reset Password</a></p>
    <h1 style=\"text-align: center;padding-top: 30px\">About SmartGrader</h1>
    <p style=\"text-align: justify;\">Smart Grader helps you detect plagiarism in your assignments, articles on your blog, assignments, research papers and exam submissions. You can easily check your documents authenticity in just a few seconds with higher speed and accuracy.</p>

</div>
<div style=\"background-color: #37474F;display: flex;\">
    <div style=\"width: 50%;padding: 15px\">
        <h3 style=\"text-align: center;color: #e0e0e0;\">GET IN TOUCH</h3>
        <p style=\"text-align: center;color: #e0e0e0;\">Smart Grader team is always keen to support you in all possible ways. We'd love to hear from you!</p>
    </div>
    <div style=\"width: 50%;padding: 15px\">
        <h3 style=\"text-align: center;color: #e0e0e0;\">Developers</h3>
        <p style=\"color: #e0e0e0;text-align: center;\">Kalyan:&nbsp;&nbsp;rokkamsatyakalyan@gmail.com</p>
        <p style=\"color: #e0e0e0;text-align: center;\">Srikanth:&nbsp;&nbsp;srikanth.a9500@gmail.com</p>
        
    </div>
</div>

</body>
</html>
";
        if(mail($to,$subject,$message,$headers))
        {
            echo "We have sent the password reset link to your email.";
        }


    }

?>



<?php

// $temp=



?>