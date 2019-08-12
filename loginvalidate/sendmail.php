<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include_once 'connect.php';
	$mail = $_POST["mail"];
	$tempres = mysqli_query($conn,"SELECT email from logintable where email= '".$mail."'");

	if(mysqli_num_rows($tempres)>0){
    	header("Location: error1.php");

	}
	else{

	$token = md5(rand());
	// $token = bin2hex(random_bytes(15));
    sendmail($mail,$token);
    mysqli_query($conn,"INSERT INTO verify(email,token,id) VALUES('$mail','$token','0')");
}
}


function sendmail($to,$tokens)
{
	$subject = "Smart Grader: Email Verification";
	$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <smartgraderapp@gmail.com>' . "\r\n";
        $uri = 'http://'.$_SERVER['HTTP_HOST'];
	// $message = "
	//             <html>
	//             <head>
	//             <title>verification link For srikanthavadhanula.esy.es</title>
	//             </head>
	//             <body>
	//             <p>Click on the given link to verify your account <a href=\"$uri/loginvalidate/setpassword.php?token=$tokens\">verify</a></p>
	             
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
    <h2>Hi&nbsp;&nbsp;&nbsp; Dear User</h2>
    <p>Please click below to confirm your account activation. <a href=\"$uri/loginvalidate/setpassword.php?token=$tokens\">Confirm</a></p>
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
	    // echo "<h1>We have sent the verification link to your email , please check it out</h1>";
    header("Location: mailsent.php");

	}
}

?>

</body>
</html>