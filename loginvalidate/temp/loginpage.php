<!DOCTYPE html>
<html>
<head>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">

    <title></title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="view">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto pull-xs-none">
                
                <!--Panel-->
                <!-- <form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="mutilpart/form-data"> -->
                    <div class="card card-block z-depth-5 black-text" style="margin-top: 20%">
                        <a href="#" class="card-link black-text active">SIGN IN</a>
                        <!-- <a href="#" class="card-link white-text">SING UP</a> -->
                        <br>
                        <div class="md-form">
                            <input  class="black-text" autocomplete="off" name="username" type="text" id="username" class="form-control">
                            <label class="black-text"  class="">Username</label>    
                        </div>


                        <div class="md-form">
                            <input   class="black-text" autocomplete="off" name="password" type="password" id="password" class="form-control">
                            <label  class="black-text"  class="">Password</label>
                        </div>

                        <div class="text-xs-center">
                            <button onclick="validate()" class="btn btn-indigo">LOGIN</button>
                            <h5 class="red-text" id="error">

                            </h5>
                            <h5><a href="passrecovery.php" class="black-text">Forgot password?</a></h5>
                        </div>
                    </div>
<!-- ajax code -->

<script>
    function validate() {
        var xhttp = new XMLHttpRequest();
        // xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var name = document.getElementById("username").value;
        var pass = document.getElementById("password").value;
        xhttp.onreadystatechange = function()
        {
            if(this.readyState == 4 && this.status == 200)
            {      
                switch(parseInt(this.responseText))
                {
                    case 1:
                        window.location = "profile.php";
                        break;
                    case 2:
                        document.getElementById("error").innerHTML = "please check username and password";
                        break;
                    default:
                        break;

                }
            }
        };
        xhttp.open("GET","validate.php?name="+name+"&pass="+pass,true);
        xhttp.send();
        // body...
    }
</script>


            </div>
        </div>
    </div>
</div>





 <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>
</html> 