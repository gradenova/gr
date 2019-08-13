<?php session_start();
$email = $_SESSION['username'];

include_once '../loginvalidate/connect.php';
$query = mysqli_query($conn,"select * from projects where email="."'".$email."'");

// $result=

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled.min.css?ver=4.3.2">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smart Grader | History</title>

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
        <h1 class="text-center" style="padding-top: 30px; color: #616161"><b>History</b></h1>
        
<!-- <a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>

<a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>
 -->
 </div>

 <div class="row mx-auto container" style="margin-top: 40px">
    <div class="col-sm-1"></div>
     <div class="col-sm-10">
         <table class="table">
          <thead class="thead-inverse ">
            <tr>
              <th>S.No</th>
              <th>Project Name</th>
              <th>Date Created</th>
              <th>Link</th>
            </tr>
          </thead>
          <tbody class="table-hover">


            <?php
            // echo $email;
            // var_dump("SELECT projectname,directoryname,projectdate FROM projects WHERE email = ".$email);
            // print_r($query);
            $count=1;
            // print_r($query);
            // echo $query['projectname'];
            foreach ($query as $result) {
                 # code...
             
                echo "<tr>";
                echo "<th scope=\"row\">$count</th>";
                echo "<td>".$result['projectname']."</td>";
                echo "<td>".$result['projectdate']."</td>";
                echo "<td><a href=\"displayresult.php?tablename=".$result['directoryname']."\">"."Click Here"."</td>";
                $count++;
            }


            ?>
            
            
          </tbody>
        </table>

        

     </div>
    <div class="col-sm-1"></div>

 </div>
    



                                            

<?php include '../helpers/footer.php'; ?>
    

    <!-- SCRIPTS -->

    


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