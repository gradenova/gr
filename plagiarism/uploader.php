<?php
	// ini_set('max_execution_time', 0);
set_time_limit(3600);

session_start();
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $projectname=$_POST['name'];
    include_once '../loginvalidate/connect.php';
    $to = $_SESSION['username'];   // for sending mail
	if($_FILES["zip_file"]["name"]) 
	{
		$username = $_POST["name"];
		$filename = $_FILES["zip_file"]["name"];
		$source = $_FILES["zip_file"]["tmp_name"];
		$type = $_FILES["zip_file"]["type"];
		$file_size = $_FILES["zip_file"]["size"];
		$kbsize = $file_size/1024;
		$mbsize = $kbsize/1024;
		$filedate = date("Y-m-d");
		// echo "size of file : ".$mbsize."MB";
		// echo "type : ".$type;
		$name = explode(".", $filename);
		$tempdirectory=$name[0].md5(rand());
		// echo "name : ".$name;
		// echo "".$name[1];
		$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			} 
		}
		$continue = strtolower($name[1]) == 'zip' ? true : false;
		if(!$continue) 
		{
			$message = "The file you are trying to upload is not a .zip file. Please try again.";
		}

		$target_path = $source.$filename;  // change this to the correct site path
		if(move_uploaded_file($source, $target_path)) 
		{
			$query = "INSERT INTO files(username , zippedfiles , uploaddate) VALUES('$username','$tempdirectory','$filedate')";
			mysqli_query($conn,$query);
			$zip = new ZipArchive();
			$x = $zip->open($target_path);
			if ($x === true) 
			{
				$zip->extractTo("myzips/$tempdirectory");
				$zip->close();		
				unlink($target_path);
			}
			$message = "Your .zip file was uploaded and unpacked.";
		} 
		else 
		{	
			$message = "There was a problem with the upload. Please try again.";
		}


}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled.min.css?ver=4.3.2">
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
                <p class="text-justify">Your files have been uploaded into our server. Click on the button below to continue. You can close the browser once you click the button. You will receive an email with a link to your file report. You can see the same in your dashboard. </p>
            </div>
        </div>

        <?php
        	echo "<input type=\"hidden\" id=\"secretdirectory\" value=\"$tempdirectory\">";
        	echo "<input type=\"hidden\" id=\"projname\" value=\"$projectname\">";

        ?>

        <input type="hidden" id="secretdirectory" value="$tempdirectory">
        
    	<div class="row mx-auto">
    		<div class="col-sm-5"></div>
    		<div class="col-sm-1 mx-auto">
    			<button type="button" onclick="doinbg()" class="btn btn-warning">Submit</button>
    		</div>
    		<div class="col-sm-6"></div>

    	</div>

    	<!-- <a href="backgroundprocess.php?filename=IH2016850930d73a25092e5c1c9769a9f3255caa65a">click me</a> -->
    


    

<!-- Central Modal Medium Success -->
<div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading lead">Success</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-check fa-4x mb-1 animated rotateIn"></i>
                    <p>Your files have been uploaded into our server. Click on the button below to continue. You can close the browser once you click the button. You will receive an email with a link to your file report. You can see the same in your dashboard.</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary-modal" onclick="dash()" data-dismiss="modal">Close</a>
                <!-- <a type="button" class="btn btn-outline-secondary-modal waves-effect" >Close</a> -->
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Central Modal Medium Success-->




                                            

<?php include '../helpers/footer.php'; ?>
    

    <!-- SCRIPTS -->

    
    <script language="JavaScript" type="text/javascript">


        function doinbg() {
        	var reqfilename=document.getElementById("secretdirectory").value;
        	var pro=document.getElementById("projname").value;

        	console.log(pro);
        	var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "backgroundprocess.php?filename="+reqfilename+"&projectname="+pro, true);
                xmlhttp.send();	
                $('#centralModalSuccess').modal();
        }


        function dash() {
        	// body...
        	window.location = "../home/dashboard.php";
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