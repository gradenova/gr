<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $source = $_GET['source'];
    echo $source;
    $target = $_GET['target'];





    $foldername = $_GET['tablename'];

    $sourcedocdir = "myzips/".$foldername."/".$source.".docx";
    $sourcetxtdir = "myzips/".$foldername."/".$source.".txt";
    if(file_exists($sourcedocdir))
    {
        // $string1 = trim(file_get_contents($sourcedocdir));
        $docObj1 = new DocxConversion($sourcedocdir);
                // $docObj2 = new DocxConversion($di2);
                //$docObj = new DocxConversion("test.docx");
                //$docObj = new DocxConversion("test.xlsx");
                //$docObj = new DocxConversion("test.pptx");
                // echo $docText= $docObj->convertToText();

        $string1 = trim($docObj1->convertToText());
                // $string2 = trim($docObj2->convertToText());
    }
    else if (file_exists($sourcetxtdir)) 
    {
        $string1 = trim(file_get_contents($sourcetxtdir));
    }
    $targetdocdir = "myzips/".$foldername."/".$target.".docx";
    $targettxtdir = "myzips/".$foldername."/".$target.".txt";
    if(file_exists($targetdocdir))
    {

        $docObj2 = new DocxConversion($targetdocdir);
        $string2 = trim($docObj2->convertToText());


        // $string2 = trim(file_get_contents($targetdocdir));
    }
    else if(file_exists($targettxtdir))
    {
        $string2 = trim(file_get_contents($targettxtdir));
    }

// $string1=$_GET['source'];
// $string2=$_GET['target'];


$string1 = preg_replace('!\s+!', ' ', $string1);
$string2 = preg_replace('!\s+!', ' ', $string2);

$string1=str_replace(". ", ".", $string1);
$string2=str_replace(". ", ".", $string2);

// $string1=str_replace(".", " ", $string1);
// $string2=str_replace(".", " ", $string2);

$string1=str_replace(" ,", ",", $string1);
$string2=str_replace(" ,", ",", $string2);



$arr = explode(" ", $string2);

$totalwords=sizeof($arr);


$farray=array();
for ($i=0; $i < sizeof($arr)-2 ; $i++) { 

    if(sizeof(SearchString($string1,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]))>0){
        array_push($farray,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]);
    }
}


$sentences=array();
$tempvar=$farray[0];

for ($i=1; $i < sizeof($farray) ; $i++) { 
    $exist=explode(" ", trim($tempvar));


    $fary=explode(" ", trim($farray[$i]));


    if (trim($exist[sizeof($exist)-2])===trim($fary[0]) && trim($exist[sizeof($exist)-1])===trim($fary[1])) {
        $tempvar=$tempvar." ".$fary[2];
    }
    else{
        array_push($sentences, trim($tempvar));
        $tempvar=$farray[$i];
    }
}

array_push($sentences, trim($tempvar));

// echo($tempstr);



$wordcount=0;
foreach ($sentences as $counter) {
    // $wordcount+=sizeof(explode(" ", $counter));
    $wordcount+=strlen($counter);
}


// $percent = ($wordcount/$totalwords)*100;

$percent=round(($wordcount/strlen($string2))*100);

// $finalres=Highlight($sentences,$string1)."kallaklakkal".Highlight($sentences,$string2)."kallaklakkal".$percent;
// return $= array('' => , );

// echo $finalres;

$hil1=Highlight($sentences,$string1);
$hil2=Highlight($sentences,$string2);

}



function SearchString($str, $pat)
{
    $retVal = array();
    $M = strlen($pat);
    $N = strlen($str);
    $i = 0;
    $j = 0;
    $lps = array();

    ComputeLPSArray($pat, $M, $lps);

    while ($i < $N)
    {
        if ($pat[$j] == $str[$i])
        {
            $j++;
            $i++;
        }

        if ($j == $M)
        {
            array_push($retVal, $i - $j);
            $j = $lps[$j - 1];
        }

        else if ($i < $N && $pat[$j] != $str[$i])
        {
            if ($j != 0)
                $j = $lps[$j - 1];
            else
                $i = $i + 1;
        }
    }

    return $retVal;
}

function ComputeLPSArray($pat, $m, &$lps)
{
    $len = 0;
    $i = 1;

    $lps[0] = 0;

    while ($i < $m)
    {
        if ($pat[$i] == $pat[$len])
        {
            $len++;
            $lps[$i] = $len;
            $i++;
        }
        else
        {
            if ($len != 0)
            {
                $len = $lps[$len - 1];
            }
            else
            {
                $lps[$i] = 0;
                $i++;
            }
        }
    }
}
// $data = "the quick brown fox jumps over the lazy dog";
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


function Highlight($sentences,$string2)
{

$tempstr=$string2;
$pos=0;
$length=47;
$redfront="<span style=\"background-color: #ffcdd2\">";


$redback="</span>";

$dictionary= new splFixedArray(strlen($string2));

foreach ($sentences as $sen) {
    $sen2=$sen." ";
    $positions=SearchString($string2,trim($sen));
    foreach ($positions as $position) {
        $dictionary[$position]=$sen;
    }

}


for ($i=0; $i < sizeof($dictionary) ; $i++) { 
    if(!is_null($dictionary[$i])){
        $index=$i;
        $index=$index+$pos;
        $tempstr = substr_replace($tempstr, $redfront, $index, 0);
        $temppos = $index+40+strlen($dictionary[$i]);
        $tempstr = substr_replace($tempstr, $redback, $temppos, 0);
        $pos+=47;
    }
}


return $tempstr;


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../img/favicon.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Smart Grader | Comparision</title>

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
        <h3 class="text-center" style="padding-top: 30px; color: #616161"><b><?php echo $_GET['source']." &nbsp; Vs &nbsp; ".$_GET['target']; ?></b></h3>

    </div>

    <div class="container">
        <button type="button" onclick="window.history.back()" class="btn btn-primary">Back</button>
    </div>

    <div class="row mx-auto container" style="margin-top: 30px">
        <div class="col-sm-12">
            <h3 class="text-center" style="margin-bottom: 50px"><?php echo $percent."% "; ?>of the content is Plagiarised.</h3>
        </div>
        <div class="col-sm-6" style="text-align: justify;">

            <?php echo $hil1; ?>
        </div>
        <div class="col-sm-6" style="text-align: justify;">
            <?php echo $hil2; ?>
            
        </div>
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