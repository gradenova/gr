<?php

$text="mahatma is a";

// echo $text;

$string = urlencode($text);

$file = file_get_contents("https://www.google.co.in/search?q=$string&aqs=chrome..69i57.12078j0j4&sourceid=chrome&ie=UTF-8");



$temp1 = explode("<div id=\"ires\">", $file);

// echo $temp1[0];	
$temp2 =explode( "</ol>",$temp1[1]);

$temp3=explode("<ol>", $temp2[0]);

// echo $temp2[1];

$temp4=explode("<div class=\"g\">", $temp3[1]);

$firstresult = $temp4[1];

// echo $firstresult;


$temp5= explode("<cite>", $firstresult);
$temp6= explode("</cite>", $temp5[1]);

$urllink=strip_tags($temp6[0]);


$description = strip_tags($temp6[1]);

$description= substr($description, 13);

?>