<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled.min.css?ver=4.3.2">
    <link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/plugins/wysija-newsletters/css/validationEngine.jquery.css?ver=2.7.10">
    <link rel="icon" href="img/favicon.ico">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Smart Grader Plagiarism Detector" />
    <meta property="og:description" content="Smart Grader helps you detect plagiarism in your assignments, articles on your blog, assignments, research papers and exam submissions. You can easily check your documents authenticity in just a few seconds with higher speed and accuracy." />
    <meta property="og:url" content="http://smartgrader.tk/" />
    <meta property="og:site_name" content="Smart Grader" />
    <meta property="og:image" content="https://scontent-sit4-1.xx.fbcdn.net/v/t1.0-9/18765621_124289374813562_8183114570106518045_n.jpg?oh=cd0ac8d27ce35b000bc9f2cedc1107c8&oe=59B94C30" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smart Grader | Home</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">

    <!-- Template styles -->
    <style>
        /* TEMPLATE STYLES */
        
        html,
        body,
        .view {
            height: 100%;
        }
        /* Navigation*/
        
        .navbar {
            background-color: transparent;
        }
        
        .scrolling-navbar {
            -webkit-transition: background .5s ease-in-out, padding .5s ease-in-out;
            -moz-transition: background .5s ease-in-out, padding .5s ease-in-out;
            transition: background .5s ease-in-out, padding .5s ease-in-out;
        }
        
        .top-nav-collapse {
            background-color: #3c4f74;
        }
        
        footer.page-footer {
            background-color: #3c4f74;
            margin-top: 2rem;
        }
        
        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }
        /*Call to action*/
        
        .flex-center {
            color: #fff;
        }
        
        .view {
            background: url("img/bg.jpg")no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        /*Contact section*/
        
        #contact .fa {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1C2331;
        }
    </style>

</head>

<body> 


    <!-- navbar for dekstop version -->
    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark fixed-top scrolling-navbar hidden-md-down">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <strong>Smart Grader</strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home/about.php">About</a>
                    </li>
                    <li class="nav-item dropdown btn-group">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Features</a>
                        <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="features/onlinechecker.php">Online Plagiarism</a>
                            <a class="dropdown-item" href="features/sidebyside.php">Side by side comparision</a>
                            <a class="dropdown-item" href="features/bulkcomparision.php">Bulk Crosschecker</a>

                            <a class="dropdown-item" href="features/autograder.php">Auto Grader</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home/contact.php">Contact</a>

                    </li>
                    <li style="padding-top: 10px;padding-left: 20px">
                        <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.smartgrader.tk&layout=button&size=small&mobile_iframe=true&appId=260991071033935&width=58&height=20" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </li>
                </ul>

                <?php

                    if (isset($_SESSION['username'])) {
                        ?>
                        <ul class="navbar-nav ml-auto">

                        <li>
                            <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> <?php echo explode("@",$_SESSION['username'])[0];?></a>
                        </li>

                            <li>
                                <a class="nav-link" href="home/dashboard.php">&nbsp;&nbsp;<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;DashBoard</a>
                            </li>

                            <li>
                                <a class="nav-link" href="loginvalidate/logout.php">&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a>
                            </li>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <ul class="navbar-nav ml-auto">
                            <li>
                                <a class="nav-link" href="loginvalidate/login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Login</a>
                            </li>

                            <li>
                                <a class="nav-link" href="loginvalidate/signup.php">&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SignUp</a>
                            </li>
                        </ul>
                        <?php
                    }

                ?>

                <!-- <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link" href="loginvalidate/login.php">Login</a>
                    </li>

                    <li>
                        <a class="nav-link" href="#">SignUp</a>
                    </li>
                </ul> -->
                <!-- <form class="form-inline waves-effect waves-light" action="#">
                    <input class="form-control" type="text" placeholder="Username">
                    <input class="form-control" type="password" placeholder="Password">
                    <button class="btn btn-unique" type="submit" value="Submit">Login</button>


                </form> -->
            </div>
        </div>
    </nav>

    <!-- end of navbar for desktop version -->


    <!-- navbar for mobile version -->

    <nav class="navbar navbar-toggleable-md navbar-dark black hidden-lg-up">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <!-- <strong>Smart Grader</strong> -->
                <strong><img height="60%" width="60%" class="img-fluid" src="img/autograder.png"></strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav1">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="home/about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Features</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <a class="dropdown-item waves-effect waves-light" href="features/onlinechecker.php">Online Plagiarism</a>
                            <a class="dropdown-item waves-effect waves-light" href="features/sidebyside.php">Side by Side comparision</a>
                            <a class="dropdown-item waves-effect waves-light" href="features/bulkcomparision.php">Bulk CrossChecker</a>
                            <a class="dropdown-item waves-effect waves-light" href="features/autograder.php">Auto Grader</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="home/contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>





    <!-- end of navbar for mobile version -->





    <!--/.Navbar-->
    
    <!--Mask-->
    <div class="view hm-black-strong">
        <div class="full-bg-img flex-center container">
            <ul>
                <li>
                    <h1 class="h1-responsive wow fadeInDown" data-wow-delay="0.2s">Smart Grader &amp; Plagiarism Checker</h1></li>
                <li>
                    <p class="wow fadeInDown">Sit back and relax! We will do it for you.</p>
                </li>
                <li class="hidden-md-down">
                    <a href="plagiarism/onlinechecker.php" class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.2s" rel="nofollow">Check Plagiarism</a>
                    <a href="autograder/autograder.php" class="btn btn-default btn-lg wow fadeInRight" data-wow-delay="0.2s" rel="nofollow">Try Auto-Grader</a>
                </li>
                <li class="hidden-lg-up">
                    <a href="features/onlinechecker.php" class="btn btn-primary btn-lg wow fadeInLeft" data-wow-delay="0.2s" rel="nofollow">Check Plagiarism</a>
                    <a href="features/autograder.php" class="btn btn-default btn-lg wow fadeInRight" data-wow-delay="0.2s" rel="nofollow">Try Auto-Grader</a>
                </li>
                <li class="hidden-lg-up">
                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.smartgrader.tk&layout=button&size=small&mobile_iframe=true&appId=260991071033935&width=58&height=20" width="58" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                </li>
                <li style="margin-top: 100px" class="wow">
                    <p class="hidden-md-down animated bounce infinite">Scroll down for more</p>

                    <p class="hidden-lg-up animated bounce infinite">To avail the features of our website please open in desktop / laptop </p>
                </li>
            </ul>
        </div>
    </div>
    <!--/.Mask-->

    <!-- Main container-->
    <div class="container hidden-md-down"  style="margin-top: 80px">

        <div>
            <h2 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;font-size: 50px"><b>About Smart Grader</b></h2>
        </div>

        <!--Section: About-->
        <section id="about" class="text-center wow fadeIn" data-wow-delay="0.2s" style="margin-top: 50px;margin-bottom: 60px">

            <p style="font-size: 25px;color: #9e9e9e">Smart Grader helps you detect plagiarism in your assignments, articles on your blog, assignments, research papers and exam submissions. You can easily check your documents authenticity in just a few seconds with higher speed and accuracy.</p>
            <!-- <p style="font-size: 25px;color: #455a64">No need to waste your time spending idle while running bulk files. You can work freely while your files will be processed on our server. You will receive a notification once the task is completed</p> -->

        </section>
        <!--Section: About-->

        <!-- <div class="divider-new">
            <h2 class="h2-responsive wow fadeIn">Best features</h2>
        </div> -->

        <div style="margin-top: 80px;margin-bottom: 80px">
            <h1 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;"><b>Best Features</b></h1>
        </div>

        <div class="row container mx-auto">
            <div class="col-sm-6 wow" data-wow-delay="0.2s" style="border-right: solid 1px #000;">
                <div class="row">
                <div class="col-sm-2"><i style="color: #e65100;font-size: 100px;padding-left: 10px" class="fa fa-tablet" aria-hidden="true"></i></div>
                <div class="col-sm-10">
                    <h4  style="width: 95%;margin-left: 5%;color: #263238"><b>Online Plagiarism Detector</b></h4>
                    <p style="text-align: justify;width: 95%;margin-left: 5%;color: #455a64">Smart Plagiarism Checker helps students, teachers, and professional researchers by checking plagiarism in their documents, quickly and accurately.</p>
                    <a href="plagiarism/onlinechecker.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                </div>
            </div>
            </div>
            <div class="col-sm-6"></div>
        </div>


        <div><p class="text-center wow" data-wow-delay="0.2s"><i class="fa fa-circle-o wow" aria-hidden="true" style="padding-top: 15px"></i></p></div>
        <div class="row container mx-auto">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 wow" data-wow-delay="0.2s" style="border-left: solid 1px #000;">
                <div class="row">
                    <div class="col-sm-10">
                        <h4  style="width: 95%;margin-left: 5%;color: #263238"><b>Side by Side Comparision</b></h4>
                            <p style="text-align: justify;width: 95%;margin-left: 5%;color: #455a64">You can compare two documents side by side to check for similarities. This feature highlights both original and alternate content wherever it finds duplicate.</p>
                            <a href="plagiarism/sidebyside.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>

                    </div>
                    <div class="col-sm-2"><i style="color: #e65100;font-size: 80px;padding-left: 20px" class="fa fa-file-text-o" aria-hidden="true"></i></div>
                </div>
            </div>
        </div>

        <div><p class="text-center wow" data-wow-delay="0.2s"><i class="fa fa-circle-o wow" aria-hidden="true" style="padding-top: 15px"></i></p></div>


        <div class="row container mx-auto">
            <div class="col-sm-6 wow" data-wow-delay="0.2s" style="border-right: solid 1px #000;">
                <div class="row">
                <div class="col-sm-2"><i style="color: #e65100;font-size: 70px;padding-left: 10px" class="fa fa-arrows" aria-hidden="true"></i></div>
                <div class="col-sm-10">
                    <h4  style="width: 95%;margin-left: 5%;color: #263238"><b>Bulk Cross Comparision</b></h4>
                    <p style="text-align: justify;width: 95%;margin-left: 5%;color: #455a64">Teachers have to check multiple assignments, a time-consuming and cumbersome task. With our Bulk Search feature, you can scan an entire batch of assignments in just one click.</p>
                    <a href="plagiarism/bulkcomparision.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                </div>
            </div>
            </div>
            <div class="col-sm-6"></div>
        </div>


        <div><p class="text-center wow" data-wow-delay="0.2s"><i class="fa fa-circle-o wow" aria-hidden="true" style="padding-top: 15px"></i></p></div>
        <div class="row container mx-auto">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 wow" data-wow-delay="0.2s" style="border-left: solid 1px #000;">
                <div class="row">
                <div class="col-sm-10">
                    <h4  style="width: 95%;margin-left: 5%;color: #263238"><b>Smart Essay Grader</b></h4>
                    <p style="text-align: justify;width: 95%;margin-left: 5%;color: #455a64">Spelling mistakes and Grammatical errors in your essay doesn't give a good impression. Submit your essay in our Smart Grader and get your errors highlighted and also get possible suggestions. </p>
                    <a href="autograder/autograder.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                </div>
                <div class="col-sm-2"><i style="color: #e65100;font-size: 80px;padding-left: 20px" class="fa fa-check-square-o" aria-hidden="true"></i></div>
            </div>
            </div>
        </div>

        <div><p class="text-center wow" data-wow-delay="0.2s"><i class="fa fa-circle-o wow" aria-hidden="true" style="padding-top: 15px"></i></p></div>

        <div class="row container mx-auto">
            <div class="col-sm-6 wow" data-wow-delay="0.2s" style="border-right: solid 1px #000;">
                <div class="row">
                <div class="col-sm-2"><i style="color: #e65100;font-size: 80px;padding-left: 10px" class="fa fa-pie-chart" aria-hidden="true"></i></div>
                <div class="col-sm-10">
                    <h4  style="width: 95%;margin-left: 5%;color: #263238"><b>Comprehensive Reports</b></h4>
                    <p style="text-align: justify;width: 95%;margin-left: 5%;color: #455a64">Reports help us rectify our errors. You can get a detailed report of your document in a html form.</p>
                    <a href="plagiarism/history.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                </div>
            </div>
            </div>
            <div class="col-sm-6"></div>
        </div>



        

        <!-- <div class="divider-new container">
            <h2 class="h2-responsive wow fadeIn">Contact us</h2>
        </div> -->

        <div style="margin-top: 90px;margin-bottom: 80px">
            <h1 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;"><b>Don't waste your valuable time.</b></h1>

            <p style="margin-top: 60px;color: #757575 ;font-size: 20px" class="wow text-center">Many plagiarism checker softwares utilize all your system resources not allowing you to do your important work. But our Smart Grader processes your files on the cloud server and notifies you throuh an email when the task is done. </p>
        </div>



        <div style="margin-top: 90px;margin-bottom: 80px">
            <h1 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;"><b>Contact Us</b></h1>

            <!-- <p style="margin-top: 60px;color: #757575 ;font-size: 20px" class="wow text-center">Many plagiarism checker softwares utilize all your system resource not allowing you to do your important work. But our Smart Grader processes your files on the cloud server and notifies you throuh an email when the task is done. </p> -->
        </div>



        <!-- <div class="container"> -->
        <!--Section: Contact-->
        <section id="contact">
            <div class="row" data-wow-delay="0.2s">
                <!--First column-->
                <div class="col-md-8">
                    <!-- <div id="map-container" class="z-depth-1 wow fadeIn" style="height: 300px"></div> -->
                    <img class="wow" data-wow-delay="0.2s" src="img/map.JPG">
                </div>
                <!--/First column-->

                <!--Second column-->
                <div class="col-md-4">
                    <ul class="text-center">
                        <li class="wow fadeIn" data-wow-delay="0.2s"><i class="fa fa-map-marker teal-text"></i>
                            <p>Gachibowli, Hyderabad, TS</p>
                        </li>

                        <li class="wow fadeIn" data-wow-delay="0.3s"><i class="fa fa-phone teal-text"></i>
                            <p>(+91) 73822 10412</p>
                        </li>

                        <li class="wow fadeIn" data-wow-delay="0.4s"><i class="fa fa-envelope teal-text"></i>
                            <p>smartgraderapp@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <!--/Second column-->
            </div>
        </section>
        <!--Section: Contact-->
        <!-- </div> -->




    </div>
    <!--/ Main container-->

    <!-- main content for mobile version -->

    <div class="hidden-lg-up container" style="margin-top: 60px">

    <div class="row container">
        <div class="col-sm-12">
            
        <h2 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;font-size: 30px"><b>About Smart Grader</b></h2>
        </div>
        <!-- <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
        </div> -->
        <div class="row text-center container wow fadeIn" data-wow-delay="0.2s" style="margin-top: 40px">
            <p style="text-align: justify;font-size: 21px;color: #9e9e9e">Smart Grader helps you detect plagiarism in your assignments, articles on your blog, assignments, research papers and exam submissions. You can easily check your documents authenticity in just a few seconds with higher speed and accuracy.</p>
        </div>
    </div>
    <br><br>
    <div class="row container">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
        <h1 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;font-size: 30px"><b>Best Features</b></h1>
        </div>
        <div class="col-sm-4"></div>
    </div>
    <br><br>

        <div class="row container">
            <div class="col-sm-12">
                <h5 style="color: #263238"><i style="color: #e65100;font-size: 30px;" class="fa fa-tablet" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<b>Online Plagiarism Detector</b></h5>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- for discription -->
                        <p style="text-align: justify;color: #455a64">Smart Plagiarism Checker helps students, teachers, and professional researchers by checking plagiarism in their documents, quickly and accurately.</p>
                        <a href="features/onlinechecker.php" style="color: #FF8800">Click here to enter >></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
         <div class="row container">
            <div class="col-sm-12">

                <h5 style="color: #263238"><i style="color: #e65100;font-size: 30px;" class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<b>Side by Side Comparision</b></h5>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- for discription -->
                        <p style="text-align: center;color: #455a64">You can compare two documents side by side to check for similarities. This feature highlights both original and alternate content wherever it finds duplicate.</p>
                            <a href="features/sidebyside.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
         <div class="row container">
            <div class="col-sm-12">
                <h5 style="color: #263238"><i style="color: #e65100;font-size: 30px;" class="fa fa-arrows" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<b>Bulk Cross Comparision</b></h5>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- for discription -->
                        <p style="text-align: center;color: #455a64">Teachers have to check multiple assignments, a time-consuming and cumbersome task. With our Bulk Search feature, you can scan an entire batch of assignments in just one click.</p>
                    <a href="features/bulkcomparision.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
         <div class="row container">
            <div class="col-sm-12">
                <h5 style="color: #263238"><i style="color: #e65100;font-size: 30px;" class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<b>Smart Essay Grader</b></h5>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- for discription -->
                       <p style="text-align: center;color: #455a64">Spelling mistakes and Grammatical errors in your essay doesn't give a good impression. Submit your essay in our Smart Grader and get your errors highlighted and also get possible suggestions. </p>
                    <a href="features/autograder.php" style="width: 95%;margin-left: 5%;color: #FF8800">Click here to enter >></a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>

         <div class="row container">
            <div class="col-sm-12">
                <h5 style="color: #263238"><i style="color: #e65100;font-size: 30px;" class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<b>Comprehensive Reports</b></h5>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- for discription -->
                       <p style="text-align: center;color: #455a64">Reports help us rectify our errors. You can get a detailed report of your document in a html form.</p>
                    
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>

        <div class="row container" style="margin-top: 50px">

            <h2 class="h2-responsive wow fadeIn text-center" data-wow-delay="0.2s" style="color: #455a64;font-size: 25px;padding-left: 25px"><b>Don't waste your valuable time.</b></h2>

            <p style="margin-top: 60px;color: #9e9e9e ;font-size: 21px" class="wow text-center container">Many plagiarism checker softwares utilize all your system resources not allowing you to do your important work. But our Smart Grader processes your files on the cloud server and notifies you throuh an email when the task is done. </p>
            
        </div>

    </div>


    <!-- end of main content for mobile version -->


    <!--Footer-->
    <footer class="page-footer center-on-small-only hidden-md-down" style="background-color: #37474f ">

        <div class="container-fluid row mx-auto">
            <div class="col-sm-4">
                <img class="img-fluid" src="img/footer.png">
                <p style="color: #bdbdbd; padding-left: 35px;font-size: 15px">Our vision is to serve our customers with reliable and quality solutions as per their preferences and needs.</p>
            </div>

            <div class="col-sm-4" style="margin-top: 35px;padding-left: 20px;padding-right: 20px">
                <h4 class="text-center">GET IN TOUCH</h4>
                <p style="color: #bdbdbd; padding-left: 35px;font-size: 15px" class="text-center">Smart Grader team is always keen to support you in all possible ways. We’d love to hear from you!</p>
                <p style="color: #bdbdbd; padding-left: 35px;font-size: 15px" class="text-center"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;smartgraderapp@gmail.com</p>

            </div>
            <div class="col-sm-4 hidden-md-down" style="margin-top: 35px;padding-left: 60px;">
                <h4 class="text-center">DEVELOPERS</h4>
                <!-- <p>Kalyan</p> -->
                <p style="color: #bdbdbd; padding-left: 35px;font-size: 15px;margin-top: 40px" class="text-center">Kalyan :&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;rokkamsatyakalyan@gmail.com<br>Srikanth :&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;srikanth.a9500@gmail.com</p>

            </div>


        </div>

        <hr>

        <!-- <div class="row mx-auto"></div> -->

        <p style="font-size: 30px;" class="text-center"><a style="color: #fff" href="https://www.facebook.com/SmartGraderApp/"><i class="fa fa-facebook" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #fff" href="https://plus.google.com/116166349329839715993"><i class="fa fa-google-plus" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-twitter" aria-hidden="true"></i></p>
        

        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © 2017 Copyright :&nbsp;&nbsp;&nbsp;smartgrader.tk
            </div>
        </div>
        <!--/.Copyright-->

    </footer>


    <!-- mobile version for footer -->
    <footer class="row hidden-lg-up center container" style="background-color: #37474f;margin-top: 50px;margin-left: 0px;margin-right: 0px">
    <!-- <div class="container-fluid row"> -->
        <div class="col-sm-12" style="margin-top: 40px">
            <img class="img-fluid" src="img/footer.png">
            <p style="color: #bdbdbd;font-size: 15px;text-align:center">Our vision is to serve our customers with reliable and quality solutions as per their preferences and needs.</p>
        </div>
        <div class="col-sm-12" style="margin-top: 40px">
            <h4 class="text-center" style="color: #fff">GET IN TOUCH</h4>
            <p style="color: #bdbdbd;font-size: 15px" class="text-center">Smart Grader team is always keen to support you in all possible ways. We’d love to hear from you!</p>
            <p style="color: #bdbdbd;font-size: 15px" class="text-center"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;smartgraderapp@gmail.com</p>
        </div>
        <div class="col-sm-12" style="margin-top: 40px">
                    <div>
                        <h4 class="text-center" style="color: #fff">DEVELOPERS</h4>
                    </div>
                    <div>
                        <div style="margin-top: 30px">
                       <p class="text-center" style="color: #bdbdbd"> Kalyan :&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;rokkamsatyakalyan@gmail.com</p>
                        </div>
                        <div>
                        <p class="text-center" style="color: #bdbdbd">Srikanth :&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;srikanth.a9500@gmail.com</p> 
                        </div>
                    </div>
        </div>
        <div class="col-sm-12" style="margin-top: 40px">
            <!-- social media links -->
        <hr>

        <p style="font-size: 30px;" class="text-center"><a style="color: #fff" href="https://www.facebook.com/SmartGraderApp/"><i class="fa fa-facebook" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #fff" href="https://plus.google.com/116166349329839715993"><i class="fa fa-google-plus" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #fff"><i class="fa fa-twitter" aria-hidden="true"></i></a></p>



        </div>
        <div class="col-sm-12" style="margin-top: 40px">
            <!-- copyrights -->

            <div class="text-center footer-copyright">
                <p style="font-size: 15px; color: #fff">© 2017 Copyright :&nbsp;&nbsp;&nbsp; smartgrader.tk </p>
            </div>
        </div>
    <!-- </div> -->
    </footer>

    <!-- end of mobile version for footer -->
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <!--Google Maps-->
    

    <!-- Animations init-->
    <script>
        new WOW().init();
        $( ".wow" ).addClass( "fadeInUp" );

    </script>


</body>

</html>