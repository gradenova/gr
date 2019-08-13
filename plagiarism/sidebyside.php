<?php
session_start();
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

    <title>Smart Grader | Side By Side Checker</title>

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
            overflow-y: auto;
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
        <h1 class="text-center" style="padding-top: 30px; color: #616161"><b>Welcome to our Side by Side Comparision tool!</b></h1>
        
<!-- <a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>

<a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>
 -->
    </div>

        <div class="col container mx-auto row ">
            <div class="col-sm12" style="width: 80%;margin-left: 10%;margin-right: 10%;padding-top: 30px">
                <p class="text-justify">This powerful tool lets you compare two texts for similarity. Our intelligent algorithm detects all possible matches and highlights them in red color. You can see the similarity percentage in the results area. Source file is the original text. Target file is the one which you want to check. Paste your text in the text area given below and click the button to see the results.</p>
            </div>
        </div>

    <div class="container row mx-auto " style="padding-top: 30px">
        
        <div class="col-lg-6">
            
            <h4 class="text-center"><span style="color: green"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></span><b>&nbsp;&nbsp;&nbsp;Source text.</b></h4>
            <div class="md-form" style=" padding-top: 20px" id="sourcediv">
                <textarea name="q" style="min-height: 200px; border: solid 1px; border-radius: 10px;padding: 5px;padding-right: 0px; width: 90%;overflow-y: auto;" type="text" id="sourcearea" class="md-textarea"></textarea>
                <label for="gradertext" style="padding-left: 10px;padding-top: 20px">Enter Your Text Here</label>
            </div>
            
            <!-- <div style="padding-left: 140px">
                
            
                
            </div> -->


        </div>
        
        <div class="col-lg-6">
            
            <h4 class="text-center"><span style="color: #ff4444"><i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i></span><b>&nbsp;&nbsp;&nbsp;Target text.</b></h4>
            <div class="md-form" style=" padding-top: 20px" id="targetdiv">
                <textarea name="q" style="min-height: 200px; border: solid 1px; border-radius: 10px;padding: 5px;padding-right: 0px; width: 90%;overflow-y: auto;" type="text" id="targetarea" class="md-textarea"></textarea>
                <label for="gradertext" style="padding-left: 10px;padding-top: 20px">Enter Your Text Here</label>
            </div>
            <!-- <input type="hidden" value="0" name="secret"> -->
            
            <!-- onclick="processgrade()" -->
            <!-- <div style="padding-left: 140px">
                
            
                
            </div> -->
        <!-- </form> -->

        <!-- <p class="text-center">OR</p> -->

        </div>

        

    </div>

    <div id="buttons" style="margin-top: 30px">
        <!-- <div class="col-sm-12"> -->
            <p class="text-center"><a type="buttons" class="btn btn-secondary" onclick="crosscheck()">Start Analysing</a></p>
            <!-- <button style="margin-left: 550px"  type="submit" onclick="crosscheck()" class="btn btn-secondary mx-auto" >Start Analysing -->
            <!-- </button> -->
        <!-- </div> -->



        
    </div>

        


    




<?php include '../helpers/footer.php'; ?>
 
    

    <!-- SCRIPTS -->

    
    <script language="JavaScript" type="text/javascript">

        // var fileInputTextDiv = document.getElementById('file_input_text_div');
        // var fileInput = document.getElementById('file_input_file');
        // var fileInputText = document.getElementById('file_input_text');

        // fileInput.addEventListener('change', changeInputText);
        // fileInput.addEventListener('change', changeState);

        // function changeInputText() {
        //   var str = fileInput.value;
        //   var i;
        //   if (str.lastIndexOf('\\')) {
        //     i = str.lastIndexOf('\\') + 1;
        //   } else if (str.lastIndexOf('/')) {
        //     i = str.lastIndexOf('/') + 1;
        //   }
        //   fileInputText.value = str.slice(i, str.length);
        // }

        // function changeState() {
        //   if (fileInputText.value.length != 0) {
        //     if (!fileInputTextDiv.classList.contains("is-focused")) {
        //       fileInputTextDiv.classList.add('is-focused');
        //     }
        //   } else {
        //     if (fileInputTextDiv.classList.contains("is-focused")) {
        //       fileInputTextDiv.classList.remove('is-focused');
        //     }
        //   }
        // }


        function crosscheck() {

            var source = document.getElementById("sourcearea").value;
            var target = document.getElementById("targetarea").value;
            evaluate(source,target);

        }


        
        function evaluate(source,target) {

            // str=x;


            if (source.length == 0 || target.length == 0) { 
                document.getElementById("targetarea").value = "";
                document.getElementById("sourcearea").value = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        var array=this.responseText.split("kallaklakkal");

                        var len1=array[0].length;
                        var len2=array[1].length;

                        


                        document.getElementById("sourcediv").innerHTML="<div class=\"editable\" style=\"text-align: justify;border: solid 1px #000000;padding: 15px\">"+array[0]+"</div>";
                        document.getElementById("targetdiv").innerHTML="<div class=\"editable\" style=\"text-align: justify;border: solid 1px #000000;padding: 15px\">"+array[1]+"</div>";


                        // if(len1>len2){
                        //     var diff=len1-len2;
                        //     for (var i = 0; i < diff; i++) {
                        //         document.getElementById("sourcediv").innerHTML+="&nbsp;";
                        //     }
                        // }
                        // else{
                        //     var diff=len2-len1;
                        //     for (var i = 0; i < diff; i++) {
                        //         document.getElementById("sourcediv").innerHTML+="&nbsp;";
                        //     }
                        // }

                        var plag=parseInt(array[2]);
                        var uniq=100-plag;

                        document.getElementById("buttons").innerHTML="<div class=\"col-sm-12\" style=\"margin-top: 20px;\"><h3 class=\"text-center\" style=\"color: #ff4444\"><span style=\"font-size: 35px\">"+plag+"% </span>of the target file has been Plagiarised.</h3></div><div class=\"col-sm-12\" style=\"margin-top: 20px;\"><h3 class=\"text-center\" style=\"color: #00C851\"><span style=\"font-size: 35px\">"+uniq+"% </span>of the target file is Unique.</h3></div>"+"<div class=\"col-sm-12\" style=\"width: 20%;margin-left: 43%;margin-right: 37%;margin-top:20px\"><a href=\"sidebyside.php\" class=\"btn btn-primary\">Check Again!</a></div>";
                        // var temp=document.getElementById("plagresult");


                        // temp.innerHTML=temp.innerHTML+this.responseText;
                        console.log(this.responseText);

                        

                    }
                };

                xmlhttp.open("POST", "crosschecker.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("source="+source+"&target="+target);

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