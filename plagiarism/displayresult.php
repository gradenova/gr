<?php session_start();
$email = $_SESSION['username'];

include_once '../loginvalidate/connect.php';


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

    <title>Smart Grader | Results</title>

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

<body style="background-color: #eceff1 "> 

<?php
    include '../helpers/navbar.php';
?>



    <!-- <div class="container mx-auto " style="margin-top: 75px">
        <h1 class="text-center" style="padding-top: 30px; color: #616161"><b>History</b></h1>
        

 </div> -->

 <div class="row mx-auto container" style="margin-top: 85px">
    <!-- <div class="col-sm-1"></div> -->
     <div class="col-sm-12">
         <?php
	include_once '../loginvalidate/connect.php';
	$arr = array("start");
	$table = $_GET['tablename'];
	$result = mysqli_query($conn,"SELECT Source FROM $table");
	echo "<table class=\"table table-bordered white table-responsive\"><thead class=\"table-inverted\"><tr>";
	echo "<th class=\"white-text\" style=\"background-color: #455a64\"> Files </th>"; 
	while($row = $result->fetch_assoc())
	{
			array_push($arr,$row["Source"]);
			echo "<th class=\"white-text\" style=\"background-color: #455a64\">".$row["Source"]."</th>";
	}
	echo "</tr></thead><tbody class=\"table-hover\">";
	// print_r($arr);
	$len = count($arr);
	$result = mysqli_query($conn,"SELECT * FROM $table");
	$file = 1;
	while ($row = $result->fetch_assoc()) 
	{
		echo "<tr>";
		echo "<th class=\"white-text\" style=\"background-color: #455a64\">".$arr[$file]."</th>";
		for($i = 1;$i < $len;$i++)
		{	
			if($row[$arr[$i]]>=60){

			echo "<th style=\"background-color : #ef9a9a \"><a href='compare.php?source=".$arr[$file]."&target=".$arr[$i]."&tablename=".$table."'>".$row[$arr[$i]]."</a></th>";
			}
			elseif ($row[$arr[$i]]<60 && $row[$arr[$i]]>=40) {
			echo "<th style=\"background-color : #90caf9  \"><a href='compare.php?source=".$arr[$file]."&target=".$arr[$i]."&tablename=".$table."'>".$row[$arr[$i]]."</a></th>";
				
			}
			elseif($row[$arr[$i]]==-1){
			echo "<th style=\"background-color : #fff  \">N/A</th>";

			}
      elseif ($row[$arr[$i]]==0) {
          echo "<th style=\"background-color : #a5d6a7   \"><a href='#'>".$row[$arr[$i]]."</a></th>";
        }
			else{
			     echo "<th style=\"background-color : #a5d6a7   \"><a href='compare.php?source=".$arr[$file]."&target=".$arr[$i]."&tablename=".$table."'>".$row[$arr[$i]]."</a></th>";


			}


		}
		echo "</tr>";
		$file++;
	}
	echo "</tbody></table>";

?>
        

     </div>
    <!-- <div class="col-sm-1"></div> -->

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
