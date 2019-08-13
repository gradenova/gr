<?php
// ini_set('max_execution_time', 0);
set_time_limit(3600);
session_start();

include '../loginvalidate/connect.php';
$message = "";
if($_SERVER["REQUEST_METHOD"] == "GET")
{		

	
	$to=$_SESSION['username'];
		$tempdirectory=$_GET['filename'];
		$projectname=$_GET['projectname'];

		$dir    = "myzips/$tempdirectory/";
		$files1 = scandir($dir);
		array_splice($files1,0,2);
		$count = count($files1);
		// $unique = randomString(5);
		// $tablename = $username."_".$unique;

		$columns = "";
		for($i=0;$i<$count;$i++) 
			{
				$fm = explode(".", $files1[$i]);
				$columns .= $fm[0];
				if($i != ($count-1))
				{
					$columns .= " int,";
				}
				else
				{
					$columns .= " int";
				}
			}



		$col = "Source,";
		for($i=0;$i<$count;$i++) 
			{
				$fm = explode(".", $files1[$i]);
				$col .= $fm[0];
				if($i != ($count-1))
				{
					$col .= ",";
				}
			}


		mysqli_query($conn,"CREATE TABLE ".$tempdirectory." (Source varchar(225),".$columns.")");
		// var_dump("CREATE TABLE ".$tablename." (Source varchar(225),".$columns.")");

		 
			
		
		$con=0;
		$na = 0;
			foreach ($files1 as $pattern) 
			{
				$sourceVal = explode(".",$pattern);
				$val = "'".$sourceVal[0]."',";
				// echo "<tr><th>".$pattern."</th>";
				for($i = 0; $i < $count ; $i++)
					{
						if($i === $na)
						{
							$val .= "'-1'";
							if($i != $count-1)
							{
								$val .= ",";
							}
							// echo "<th> N/A</th>";
						}
						else
						{
							
  							$s1 = $dir.$pattern;
  							$s2 = $dir.$files1[$i];
  							$res = checkplag($s1,$s2);
							$val .= "'".$res."'";
							if($i != $count-1)
							{
								$val .= ",";
							}
							// echo "<th><a href='#'>".$res."</a></th>";
							$con++;
						}
					}
					mysqli_query($conn,"INSERT INTO ".$tempdirectory." (".$col.") VALUES(".$val.")");
					// var_dump("INSERT INTO ".$tablename." (".$col.") VALUES(".$val.")");
					$na = $na + 1;
				// echo "</tr>";
			}

		
			$prodate=date("Y-m-d");

mysqli_query($conn,"INSERT INTO projects(email,directoryname,projectname,projectdate) VALUES('$to','$tempdirectory','$projectname','$prodate')");


$subject = "Smart Grader: $projectname";
	$headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <smartgraderapp@gmail.com>' . "\r\n";
        $uri = 'http://'.$_SERVER['HTTP_HOST'];
// $message = 'link for the project :  <a href="$uri/plagiarism/displayresult.php?tablename=$tempdirectory">click here</a>';

$message="<!DOCTYPE html>
<html>
<head>
    <title>Smart Grader</title>
</head>
<body style=\"border: solid 1px #000;\">
    <div style=\"background-color: #37474f\">
        <img src=\"http://smartgrader.tk/img/footer.png\">
    </div>
<div style=\"padding: 50px;\">
    <h2>Hi&nbsp;&nbsp;&nbsp; Dear User,</h2>
    <p>Your project <b>$projectname</b> has been processed. To see the results, click here <a href=\"$uri/plagiarism/displayresult.php?tablename=$tempdirectory\">See Results.</a></p>
    <p>You can also see your results in your Dashboard.</p>
    <h1 style=\"text-align: center;padding-top: 30px\">About SmartGrader</h1>
    <p style=\"text-align: justify;\">Smart Grader helps you detect plagiarism in your assignments, articles on your blog, assignments, research papers and exam submissions. You can easily check your documents authenticity in just a few seconds with higher speed and accuracy.</p>

</div>
<div style=\"background-color: #37474F;display: flex;\">
    <div style=\"width: 50%;padding: 15px\">
        <h3 style=\"text-align: center;color: #e0e0e0;\">GET IN TOUCH</h3>
        <p style=\"text-align: center;color: #e0e0e0;\">Smart Grader team is always keen to support you in all possible ways. We'd love to hear from you!</p>
    </div>
    <div style=\"width: 50%;padding: 15px\">
        <h3 style=\"text-align: center;color: #e0e0e0;\">Developers</h3>
        <p style=\"color: #e0e0e0;text-align: center;\">Kalyan:&nbsp;&nbsp;rokkamsatyakalyan@gmail.com</p>
        <p style=\"color: #e0e0e0;text-align: center;\">Srikanth:&nbsp;&nbsp;srikanth.a9500@gmail.com</p>
        
    </div>
</div>

</body>
</html>
";


mail($to,$subject,$message,$headers);

	// }

}

function readmyfile($filename)
{	
	$string="";
	$myfile = fopen($filename, "r") or die("Unable to open file!");
        // Output one line until end-of-file
        while(!feof($myfile)) {
          $string=$string.fgets($myfile);
        }
        fclose($myfile);
        return $string;
}

// function read_docx($filename){

//     $striped_content = '';
//     $content = '';

//     if(!$filename || !file_exists($filename)) return false;

//     $zip = zip_open($filename);
//     if (!$zip || is_numeric($zip)) return false;

//     while ($zip_entry = zip_read($zip)) {

//         if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

//         if (zip_entry_name($zip_entry) != "word/document.xml") continue;

//         $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

//         zip_entry_close($zip_entry);
//     }
//     zip_close($zip);      
//     $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
//     $content = str_replace('</w:r></w:p>', "\r\n", $content);
//     $striped_content = strip_tags($content);

//     return $striped_content;
// }

function randomString($length)
		{
			$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$charLen = strlen($characters);
			$tn = "";
			for ($i=0; $i < $length ; $i++)
			{
				$temp = mt_rand(0,$charLen-1);
				$tn .= $characters[$temp];
			}
			return $tn;
		}


function checkplag($filename1,$filename2)
		{

			// echo $filename1."f1";
			// echo "<br>";
			// echo $filename2."f2";
			// echo "<br>";

			$temp1=explode(".", $filename1);
			$temp2=explode(".", $filename2);
			// echo $temp1[1];

			$di1=$dir.$filename1;
			$di2=$dir.$filename2;

			if ($temp1[1]==="txt") {
				# code...
				$string1 = trim(readmyfile($filename1));
				$string2 = trim(readmyfile($filename2));
			}else{
				$docObj1 = new DocxConversion($di1);
				$docObj2 = new DocxConversion($di2);
				//$docObj = new DocxConversion("test.docx");
				//$docObj = new DocxConversion("test.xlsx");
				//$docObj = new DocxConversion("test.pptx");
				// echo $docText= $docObj->convertToText();

				$string1 = trim($docObj1->convertToText());
				$string2 = trim($docObj2->convertToText());
			}




			// var_dump($string1);


			// echo "String 1 : ".$string1."<br>";
			// echo "String 2 : ".$string2."<br>";

	// 		$string1=$_GET['source'];
	// 		$string2=$_GET['target'];


			$string1 = preg_replace('!\s+!', ' ', $string1);
			$string2 = preg_replace('!\s+!', ' ', $string2);

			$string1=str_replace(". ", ".", $string1);
			$string2=str_replace(". ", ".", $string2);

			$string1=str_replace(" ,", ",", $string1);
			$string2=str_replace(" ,", ",", $string2);



			$arr = explode(" ", $string2);

			$totalwords=sizeof($arr);


			$farray=array();
			for ($i=0; $i < sizeof($arr)-2 ; $i++) 
			{ 

				if(sizeof(SearchString($string1,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]))>0)
				{
					array_push($farray,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]);
				}
			}


	$sentences=array();
	$tempvar=$farray[0];


	for ($i=1; $i < sizeof($farray) ; $i++) 
	{ 
		$exist=explode(" ", trim($tempvar));


		$fary=explode(" ", trim($farray[$i]));

		// print_r($fary);

		if (trim($exist[sizeof($exist)-2])===trim($fary[0]) && trim($exist[sizeof($exist)-1])===trim($fary[1])) 
		{
			$tempvar=$tempvar." ".trim($fary[2]);
		}
		else
		{
			array_push($sentences, trim($tempvar));
			$tempvar=$farray[$i];
		}
	}

	array_push($sentences, trim($tempvar));

	// echo($tempstr);



	$wordcount=0;
	foreach ($sentences as $counter) 
	{
		// $wordcount+=sizeof(explode(" ", $counter));
		$wordcount+=strlen($counter);
	}


	// $percent = ($wordcount/$totalwords)*100;

	$percent=($wordcount/strlen($string2))*100;

	// $finalres=Highlight($sentences,$string1)."kallaklakkal".Highlight($sentences,$string2)."kallaklakkal".$percent;
	// return $= array('' => , );

	return round($percent);

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
