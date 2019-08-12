<!DOCTYPE html>
	<html>
		<head>
			<title>Reset Password</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">


		</head>
		<body>
			<?php
			// echo "welcome to reset page";
			$token = $_GET['token'];
			include_once 'connect.php';
			$query = mysqli_query($conn,"SELECT email FROM fpmail WHERE token = '$token' and id = '0'");
			$numrows = mysqli_num_rows($query);
			if($numrows == 1)
			{
				while($row = mysqli_fetch_assoc($query))
				{
					$email = $row['email'];
				}
			?>
			<div class = "view">
				<div class="container">
			        <div class="row">
			            <div class="col-md-8 m-x-auto pull-xs-none">
		                    <div class="card card-block z-depth-5 black-text">
		                        <a href="#" class="card-link black-text active">Update Your Password</a>
		                        <br>
		                        <div class="md-form">
		                            <input  class="black-text" type="password" id="password1" class="form-control">
		                            <label class="black-text">password</label>    
		                        </div>


		                        <div class="md-form">
		                            <input class="black-text" type="password" id="password2" class="form-control">
		                            <label  class="black-text">Re-Enter Password</label>
		                        </div>
		                        <input type="hidden" id="email" value="<?php echo $email;?>">
		                        <div class="text-xs-center">
		                        	<p class="red-text" id="message"></p>
		                            <button onclick="updatePassword()" class="btn btn-indigo">Update Password</button>
		                        </div>
		                    </div>



			<script>
				function updatePassword()
				{
					var pwd1 = document.getElementById("password1").value;
					var pwd2 = document.getElementById("password2").value;
					var email = document.getElementById("email").value;
					if(pwd1 == pwd2 && pwd1 != "")
					{
						var xmlhttp = new XMLHttpRequest();
						xmlhttp.onreadystatechange = function()
						{
							if(this.readyState == 4 && this.status == 200)
							{
								document.getElementById("message").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET","updatepassword.php?pwd="+pwd1+"&email="+email,true);
						xmlhttp.send();
					}
					else
					{
						document.getElementById("message").innerHTML = "please check your passwords";
					}
				}

			</script>
			            </div>
			        </div>
			    </div>
		    </div>


			<?php
			}  //end of tag for it condition 
			else
			{
				// echo "please check the link OR your password has been changed before";
    header("Location: error.php");
				
			}

			?>	    


 <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>


		</body>
	</html>