



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
            <div class="col-md-8 m-x-auto pull-xs-none">
                
                <!--Panel-->
                <!-- <form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" > -->
                    <div class="card card-block z-depth-5 black-text">
                        <h2 class="card-link black-text active">FORGOT PASSWORD</h2>
                        <!-- <a href="#" class="card-link white-text">SING UP</a> -->
                        <br>
                        <div class="md-form">
                            <input  class="black-text" type="text" id="email" class="form-control">
                            <label class="black-text"  class="">Email-ID</label>    
                        </div>

                        <div class="text-xs-center">
                            <button onclick="updatepassword()" class="btn btn-indigo">UPDATE PASSWORD</button>
                            <h5 class="red-text" id="message"></h5>
                        </div>
                    </div>
                <!-- </form> -->
                <!--/.Panel-->

                <script>
                    function updatepassword() 
                    {

                            var xmlhttp = new XMLHttpRequest();
                            var email = document.getElementById("email").value;
                            xmlhttp.onreadystatechange = function() 
                            {
                                if (this.readyState == 4 && this.status == 200) 
                                {
                                    document.getElementById("message").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET", "mailvalidate.php?email=" + email, true);
                            xmlhttp.send();

                        // var xhttp = XMLHttpRequest();
                        // var email = document.getElementById("email").value;
                        // xhttp.onreadystatechange = function()
                        //  {
                        //     if(this.readyState == 4 & this.status == 200)
                        //     {
                        //         document.getElementById("message").innerHTML = this.responseText;
                        //     }
                        //  };
                        //  xhttp.open("GET","mailvalidate.php?email="+email,true);
                        //  xhttp.send();
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