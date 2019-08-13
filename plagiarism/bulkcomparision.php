<?php session_start() ;
if (!isset($_SESSION['username'])) {
    header("Location: ../loginvalidate/login.php");
    // echo "<p style=\"margin-top:100px\">hi</p>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../img/favicon.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smart Grader | Bulk Cross Comparision</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <link rel="icon" href="../img/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">

    <style type="text/css">

        .hide{
            display: none;
        }

        div.editable {
            width: 520px;
            height: 300px;
            border: 1px solid #ccc;
            padding: 5px;
        }

        .file_input_div {
  margin: auto;
  width: 250px;
  height: 40px;
}

.file_input {
  float: left;
}

#file_input_text_div {
  width: 200px;
  margin-top: -8px;
  margin-left: 5px;
}

.none {
  display: none;
}

        
    </style>

    
</head>

<body>

<?php
    include '../helpers/navbar.php';
?>



    <div class="container mx-auto " style="margin-top: 75px">
        <h1 class="text-center" style="padding-top: 30px; color: #616161"><b>Bulk Cross Comparision Tool</b></h1>
        
<!-- <a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>

<a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>
 -->
    </div>

        <div class="container mx-auto row ">
            <div class="col-sm-12" style="padding-top: 30px">
                <p class="text-justify">Teachers have to check multiple assignments, a time-consuming and cumbersome task. With our Bulk Search feature, you can scan an entire batch of assignments in just one click. You don't have to waste your time until the page reloads. We process your request on our server and remind you when the task is done while you can close the window and do your work.</p>
            </div>
        </div>


        <div class="container row mx-auto " style="margin-top: 70px;margin-bottom: 70px">
            <div class="col-sm-6 mx-auto">
                <a href="history.php" class="mx-auto"><p class="text-center"><i class="fa fa-history" style="font-size: 100px;color: #e65100" aria-hidden="true"></i></p></a>
                <a href="history.php" class="mx-auto"><h1 class="text-center" style="color: #616161"><b>History</b></h1></a>
            </div>
            <div class="col-sm-6" style="border-left: solid 1px green;">
                <form action="uploader.php" enctype="multipart/form-data" method="POST">
                    <div class="row mx-auto">
                        <div class="col-sm-12">
                            <h2 class="text-center" style="color: #616161"><b>New Comparision</b></h2>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 mx-auto" style="margin-top: 40px">
                            <div class="md-form">
                                <i class="fa fa-file-text-o prefix"></i>
                                <input type="text" id="form2" name="name" class="form-control">
                                <label for="form2">Project Name</label>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>

                        <div class="col-sm-6" style="margin-top: 20px">
                            <div class="myfile">
                                <div class="file_input_div">
                                    <div class="file_input">
                                      <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                                        <i class="fa fa-arrow-circle-o-up fa-3x" aria-hidden="true"><span style="font-size: 20px">&nbsp;&nbsp;Click here to Upload</span></i>
                                        <input id="file_input_file" class="none" type="file" name="zip_file" />
                                      </label>
                                    </div>
                                    <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                                      <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" />
                                      <label class="mdl-textfield__label" for="file_input_text"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 mx-auto" style="margin-top: 50px">
                            <button type="submit" class="btn btn-warning">Submit</button>

                        </div>
                        <div class="col-sm-3"></div>


                    </div>
                </form>
            </div>
            
        </div>
    
    


    




                                            

<?php include '../helpers/footer.php'; ?>
    

    <!-- SCRIPTS -->

    
    <script language="JavaScript" type="text/javascript">


        var fileInputTextDiv = document.getElementById('file_input_text_div');
        var fileInput = document.getElementById('file_input_file');
        var fileInputText = document.getElementById('file_input_text');

        fileInput.addEventListener('change', changeInputText);
        fileInput.addEventListener('change', changeState);

        function changeInputText() {
          var str = fileInput.value;
          var i;
          if (str.lastIndexOf('\\')) {
            i = str.lastIndexOf('\\') + 1;
          } else if (str.lastIndexOf('/')) {
            i = str.lastIndexOf('/') + 1;
          }
          fileInputText.value = str.slice(i, str.length);
        }

        function changeState() {
          if (fileInputText.value.length != 0) {
            if (!fileInputTextDiv.classList.contains("is-focused")) {
              fileInputTextDiv.classList.add('is-focused');
            }
          } else {
            if (fileInputTextDiv.classList.contains("is-focused")) {
              fileInputTextDiv.classList.remove('is-focused');
            }
          }
        }




        

    </script>

    <!-- JQuery -->
    <script type="text/javascript" src="../js/jquery-2.2.3.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="../js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>

    <!--Google Maps-->
    <!-- <script src="http://maps.google.com/maps/api/js"></script> -->

    
    <!-- Animations init-->
    <script>
        new WOW().init();
        $( ".wow" ).addClass( "fadeInUp" );

    </script>

    <script>
        $(function () {
          $('[data-toggle="popover"]').popover()
        })

        $(function () {
          $('.example-popover').popover({
            container: 'body'
          })
        })
        $('.popover').popover({
          trigger: 'hover'
          // html: true
        })
    </script>


</body>

</html>