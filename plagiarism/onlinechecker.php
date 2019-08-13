<?php session_start() ;
if (!isset($_SESSION['username'])) {
    header("Location: ../loginvalidate/login.php");
    // echo "<p style=\"margin-top:100px\">hi</p>";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ini_set('max_execution_time', 3600);
    
        $tempname=md5(uniqid(rand(), true));

        $temp = explode(".", $_FILES["filees"]["name"]);
        $newfilename = $tempname. '.' . end($temp);
        move_uploaded_file($_FILES["filees"]["tmp_name"], "temp/" . $newfilename);
    // $target_dir = "temp/";
    //     $target_file = $target_dir . basename($_FILES["filees"]["name"]);
    //     $uploadOk = 1;
    //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //     echo($target_file);
    //     move_uploaded_file($_FILES["filees"][$tempname], $target_file);

    //     echo($tempname);


        if(end($temp)==="txt"){

        $myfile = fopen("temp/$newfilename", "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) {
          $string=$string.fgets($myfile);
        }
        fclose($myfile);
        }else{

                $fna="temp/".$newfilename;

                $docObj1 = new DocxConversion($fna);

                $string = trim($docObj1->convertToText());


        }

        // unlink("temp/$newfilename");



}

class DocxConversion{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
    }

    private function read_doc() {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));   
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
          {
            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
              {
              } else {
                $outtext .= $thisline." ";
              }
          }
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
        return $outtext;
    }

    private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

 /************************excel sheet************************************/

function xlsx_to_text($input_file){
    $xml_filename = "xl/sharedStrings.xml"; //content file name
    $zip_handle = new ZipArchive;
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text = strip_tags($xml_handle->saveXML());
        }else{
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}

/*************************power point files*****************************/
function pptx_to_text($input_file){
    $zip_handle = new ZipArchive;
    $output_text = "";
    if(true === $zip_handle->open($input_file)){
        $slide_number = 1; //loop through slide files
        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index);
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text .= strip_tags($xml_handle->saveXML());
            $slide_number++;
        }
        if($slide_number == 1){
            $output_text .="";
        }
        $zip_handle->close();
    }else{
    $output_text .="";
    }
    return $output_text;
}


    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
        {
            if($file_ext == "doc") {
                return $this->read_doc();
            } elseif($file_ext == "docx") {
                return $this->read_docx();
            } elseif($file_ext == "xlsx") {
                return $this->xlsx_to_text();
            }elseif($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../img/favicon.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smart Grader | Online Plagiarism Detector</title>

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
        <h1 class="text-center" style="padding-top: 30px; color: #616161"><b>Welcome to our Online Plagiarism checker Software!</b></h1>
        
<!-- <a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>

<a data-toggle="popover" data-trigger="hover" data-html="true" title="Dismissible popover" data-content="<b>And here's</b> some amazing content. It's very engaging. Right? <br> hi">Dismissible popover</a>
 -->
    </div>

        <div class="container mx-auto row ">
            <div class="col-sm-12" style="padding-top: 30px">
                <p class="text-justify">This is powerful tool which checks your contents against billions of pages on the Internet. This is a powerful tool which identifies the plagiarised content and also directs you to the source on a click. Paste your text in the text area given below. If you don't have a text to copy, upload a text file and click submit. You will get the plagiarised content highlighted in red color. You can also see the percent of text plagiarised.</p>
            </div>
        </div>

    <div class="container row mx-auto " style="padding-top: 30px">
        
        <div class="col-sm-6">
            
            <h4 class="text-center"><b>Enter your text here!</b></h4>
            <div class="md-form" style=" padding-top: 20px">
                <textarea name="q" style="min-height: 200px; border: solid 1px; border-radius: 10px;padding: 5px;padding-right: 0px; width: 90%;overflow-y: auto;" type="text" id="gradertext" class="md-textarea"><?php if ($_SERVER['REQUEST_METHOD'] === 'POST'){echo $string;} ?></textarea>
                <label for="gradertext" style="padding-left: 10px;padding-top: 20px">Basic textarea</label>
            </div>
            <!-- <input type="hidden" value="0" name="secret"> -->
            
            <!-- onclick="processgrade()" -->
            <div style="padding-left: 140px">
                
            <button type="submit" onclick="processrequest()" class="btn btn-secondary mx-auto" >Start Analysing
            </button>
                
            </div>
        <!-- </form> -->

        <!-- <p class="text-center">OR</p> -->

        </div>
        
        <div class="col-sm-6">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="POST">
            <!-- <input type="hidden" value="1" name="secret"> -->

            <h4 class="text-center" style="padding-top: 10px"><b>Browse a text file</b></h4>
            <div style="padding-top: 15%">
            <div class="myfile">
                <div class="file_input_div">
                    <div class="file_input">
                      <label class="image_input_button mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-js-ripple-effect mdl-button--colored">
                        <i class="fa fa-arrow-circle-o-up fa-3x" aria-hidden="true"><span style="font-size: 20px">&nbsp;&nbsp;Click here to Upload</span></i>
                        <input id="file_input_file" class="none" type="file" name="filees" />
                      </label>
                    </div>
                    <div id="file_input_text_div" class="mdl-textfield mdl-js-textfield textfield-demo">
                      <input class="file_input_text mdl-textfield__input" type="text" disabled readonly id="file_input_text" />
                      <label class="mdl-textfield__label" for="file_input_text"></label>
                    </div>
                  </div>
                  </div>
            
            </div>
            <div style="padding-top: 145px;padding-left: 170px">
            <button class="btn btn-secondary mx-auto">Upload file</button>
            </div>
            </form>
        </div>
    </div>

    <div class="container row mx-auto plagres hide " style="padding-top: 50px">
        <div class="col-sm-12">
            <h4 class="text-center" style="color: #00695c;margin-bottom: 30px"><b>We check your content against Billions of pages. Please be patient!</b></h4>

            <div class="row mx-auto" style="border: solid 1px #000;padding-top: 25px;padding-bottom: 25px;">
                <div class="col-sm-4" id="spinner">
                    <p class="teal-text processactive intialheading" id="anlyse" style="font-size: 25px"><i class="fa fa-gear fa-spin" style="font-size:24px"></i>&nbsp;&nbsp; Analysing text</p>

                    <p class="teal-text processdone hide" style="font-size: 25px"><i class="fa fa-gear fa-spin" style="font-size:24px"></i>&nbsp;&nbsp; Analysing text</p>
                </div>
                <div class="col-sm-4" id="plagiarised">
                    <p class="red-text" style="font-size: 25px"><span id="plagpercent"></span> </p>
                </div>
                <div class="col-sm-4" id="unique">
                    <p class="green-text" style="font-size: 25px"><span id="uniquepercent"></span> </p>
                </div>

                <div class="col-sm-12">
                    <div class="progress">
                      <div id="progressbartext" class="progress-bar progress-bar-striped active" role="progressbar"
                      aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%;height: 20px;padding-top: 3px">
                        40%
                      </div>
                    </div>
                </div>

            </div>

            <div class="row mx-auto">
                <div class="col-sm-12" id="plagresult" style="border: solid 1px #000;margin-top: -1px;padding-top: 25px">
                    
                </div>
            </div>


            <!-- <div class="card text-center z-depth-2" style="background-color: #eeeeee">
                <div class="card-block">
                    
                </div>
            </div> -->
        </div>
    </div>

    


    




                                            

<?php include '../helpers/footer.php'; ?>
    

    <!-- SCRIPTS -->

    
    <script language="JavaScript" type="text/javascript">

    // processrequest();
        // <?php

        //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //         echo "processrequest();";
        //     }

        // ?>
    // var opcode=0;

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




        function processrequest(){

            window.scrollTo(0,600);

            var divplag = $('.plagres');
            // var animation=$('.processactive');
            // var hideanimation=$('.processdone');

            divplag.removeClass('hide');
            // animation.removeClass('hide');
            // hideanimation.addClass('hide');

            document.getElementById("plagpercent").innerHTML="";
            document.getElementById("uniquepercent").innerHTML="";
            document.getElementById("progressbartext").style.width="40%";
            document.getElementById("anlyse").innerHTML="<i class=\"fa fa-gear fa-spin\" style=\"font-size:24px\"></i>&nbsp;&nbsp; Analysing text";
            document.getElementById("progressbartext").innerHTML="40%";

            var sentences=[];

            var str=document.getElementById("gradertext").value;



            document.getElementById("plagresult").innerHTML="";
            // var spl=str.split(" ");

            var ary=str.replace(/([.?!])\s*(?=[A-Z])/g, "$1|").split("|");

            var percentcalculator="";


            for (var i = 0; i < ary.length; i++) {
                var tem=ary[i].split(" ");

                if(tem.length>15){
            

                percentcalculator=percentcalculator+ ary[i]+"akallakalkalklakal";
                    // evaluate(ary[i]);
                }
                else{
                // evaluate("\""+ary[i]+"\"");
                percentcalculator=percentcalculator+"\""+ary[i]+"\""+"akallakalkalklakal";

                }
            

            }

            // console.log(percentcalculator);
            percentcheck(percentcalculator);


        for (var i = 0; i < ary.length; i++) {

                var tem=ary[i].split(" ");

                if(tem.length>15){
            

                    evaluate(ary[i]);
                }
                else{
                evaluate("\""+ary[i]+"\"");
                }
            }
            
           //  for (var i = 0; i < spl.length; i=i+12) {
           //      var tempstr="";
           //      for (var j = 0; j< 12; j++) {
           //          if (i+j<spl.length) {
           //              tempstr=tempstr+spl[i+j]+" ";
           //          }
           //      }

           //      sentences.push(tempstr);
                
           //  }

            

           //  for (var i = 0; i < sentences.length; i++) {
           //      evaluate(sentences[i]);
                
           // }



        }

        function evaluate(x) {

            str=x;
            // var opcode="";


            // var str=$('#gradertext').html();


            if (str.length == 0) { 
                document.getElementById("gradertext").value = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var temp=document.getElementById("plagresult");
                        // console.log(this.responseText);

                        // var code=.split("######");

                        temp.innerHTML=temp.innerHTML+this.responseText;

                        // console.log(code[1]);

                        // document.getElementById("myvariable").innerHTML=code[1];

                        // console.log($('#gradertextdiv').html());
                        // return code[1];
                        // opcode= code[1];
                        // console.log(opcode);
                        // console.log(code[1]);
                        
                        

                    }
                };

                xmlhttp.open("POST", "testsearch.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("q=" + str);


                // xmlhttp.open("GET", "testsearch.php?q=" + str, true);
                // xmlhttp.send();
                // return opcode;

            }

            // return opcode;
        }

        function percentcheck(x) {
            str=x;
            

            if (str.length == 0) { 
                document.getElementById("gradertext").value = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var perplag=document.getElementById("plagpercent");
                        var peruniq=document.getElementById("uniquepercent");

                        var res=parseInt(this.responseText);
                        // var res=this.responseText;

                        perplag.innerHTML=res+"% Plagiarised ";
                        peruniq.innerHTML=100-res+"% Unique";

                        // var animation=$('.processactive');
                        // var hideanimation=$('.processdone');
// 
                        // animation.addClass('hide');
                        // hideanimation.removeClass('hide');


                        // console.log(this.responseText);

                        // var code=this.responseText.split("######");

                        // temp.innerHTML=temp.innerHTML+code[0];

                        // console.log(code[1]);

                        document.getElementById("progressbartext").style.width="100%";
                        document.getElementById("progressbartext").innerHTML="100%";
                        document.getElementById("anlyse").innerHTML=" 100% Scan Completed ";

                        // console.log($('#gradertextdiv').html());
                        // return code[1];
                        // opcode= code[1];
                        // console.log(opcode);
                        // console.log(code[1]);
                        
                        

                    }
                };

                xmlhttp.open("POST", "checkpercentage.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("q=" + str);

                // xmlhttp.open("GET", "checkpercentage.php?q=" + str, true);
                // xmlhttp.send();

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