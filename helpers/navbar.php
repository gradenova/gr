    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark black fixed-top scrolling-navbar hidden-md-down">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../index.php">

                <strong><img height="40" src="../img/autograder.png"></strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../home/about.php">About</a>
                    </li>
                    <li class="nav-item dropdown btn-group">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Features</a>
                        <div class="dropdown-menu dropdown" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="../features/onlinechecker.php">Online Plagiarism</a>
                            <a class="dropdown-item" href="../features/sidebyside.php">Side by side comparision</a>
                            <a class="dropdown-item" href="../features/bulkcomparision.php">Bulk Crosschecker</a>

                            <a class="dropdown-item" href="../features/autograder.php">Auto Grader</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../home/contact.php">Contact</a>

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
                                <a class="nav-link" href="../home/dashboard.php">&nbsp;&nbsp;<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;DashBoard</a>
                            </li>

                            <li>
                                <a class="nav-link" href="../loginvalidate/logout.php">&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a>
                            </li>
                        </ul>
                        <?php
                    }else{
                        ?>
                        <ul class="navbar-nav ml-auto">
                            <li>
                                <a class="nav-link" href="../loginvalidate/login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Login</a>
                            </li>

                            <li>
                                <a class="nav-link" href="../loginvalidate/signup.php">&nbsp;&nbsp;<i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SignUp</a>
                            </li>
                        </ul>
                        <?php
                    }

                ?>

                <!-- <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="nav-link" href="../loginvalidate/login.php">Login</a>
                    </li>

                    <li>
                        <a class="nav-link" href="#modalRegister">SignUp</a>
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
    <!--/.Navbar-->





    <nav class="navbar navbar-toggleable-md navbar-dark black hidden-lg-up">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../index.php">
            <strong><img height="60%" width="60%" class="img-fluid" src="../img/autograder.png"></strong>
                <!-- <strong>Smart Grader</strong> -->
            </a>
            <div class="collapse navbar-collapse" id="navbarNav1">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="../index.php" class="nav-link">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../home/about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Features</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <a class="dropdown-item waves-effect waves-light" href="../features/onlinechecker.php">Online Plagiarism</a>
                            <a class="dropdown-item waves-effect waves-light" href="../features/sidebyside.php">Side by Side comparision</a>
                            <a class="dropdown-item waves-effect waves-light" href="../features/bulkcomparision.php">Bulk CrossChecker</a>
                            <a class="dropdown-item waves-effect waves-light" href="../features/autograder.php">Auto Grader</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../home/contact.php" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

