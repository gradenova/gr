<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $getinput=$_POST['q'];

function longest_common_substring($words)
{
  $words = array_map('strtolower', array_map('trim', $words));
  $sort_by_strlen = create_function('$a, $b', 'if (strlen($a) == strlen($b)) { return strcmp($a, $b); } return (strlen($a) < strlen($b)) ? -1 : 1;');
  usort($words, $sort_by_strlen);
  // We have to assume that each string has something in common with the first
  // string (post sort), we just need to figure out what the longest common
  // string is. If any string DOES NOT have something in common with the first
  // string, return false.
  $longest_common_substring = array();
  $shortest_string = str_split(array_shift($words));
  while (sizeof($shortest_string)) {
    array_unshift($longest_common_substring, '');
    foreach ($shortest_string as $ci => $char) {
      foreach ($words as $wi => $word) {
        if (!strstr($word, $longest_common_substring[0] . $char)) {
          // No match
          break 2;
        } // if
      } // foreach
      // we found the current char in each word, so add it to the first longest_common_substring element,
      // then start checking again using the next char as well
      $longest_common_substring[0].= $char;
    } // foreach
    // We've finished looping through the entire shortest_string.
    // Remove the first char and start all over. Do this until there are no more
    // chars to search on.
    array_shift($shortest_string);
  }
  // If we made it here then we've run through everything
  usort($longest_common_substring, $sort_by_strlen);
  return array_pop($longest_common_substring);
}


function searchonline($kalyan)
{



// $text="We are given an array of integers and a range, we need to find whether the subarray which falls in this range has values in form of a mountain or not.";

	$text=$kalyan;

// echo $text;

$string = urlencode($text);

$file = file_get_contents("https://www.google.co.in/search?q=$string&aqs=chrome..69i57.12078j0j4&sourceid=chrome&ie=UTF-8");



$temp1 = explode("<div id=\"ires\">", $file);
$temp2 =explode( "</ol>",$temp1[1]);

$temp3=explode("<ol>", $temp2[0]);

$temp4=explode("<div class=\"g\">", $temp3[1]);

$firstresult = $temp4[1];



$temp5= explode("<cite>", $firstresult);
$temp6= explode("</cite>", $temp5[1]);

$urllink=strip_tags($temp6[0]);



// echo $urllink;



$description = strip_tags($temp6[1]);

$description= substr($description, 13);
// echo $description;



$substring=longest_common_substring(array($text,$description));



// echo "     strlen($substring)";
// echo "     strlen($text)";

// return $urllink."###k###".$description."###k###".((strlen($substring)/strlen($text))*100);

// return array($urllink,$text,(strlen($substring)/strlen($text))*100);

if((strlen($substring)/strlen($text))*100>=35){

  // echo $urllink;

  $_SESSION['plag']=$_SESSION['plag']+1;

  return "<div><p style=\"color: red; border: solid 1px #d50000;padding:5px\"><a href=\"$urllink\" style=\"color: red;\"><i class=\"fa fa-times-circle-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;&nbsp;$text&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;Plagiarised</a></p></div>";

}else{

  $_SESSION['uniq']=$_SESSION['uniq']+1;

  return "<div><p style=\"color: green; border: solid 1px #00C851;padding:5px\"><i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i>&nbsp;&nbsp;&nbsp;$text&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;Unique</p></div>";
}


}

// $variable="1. Robert Capa is a name that has for many years been synonymous with war photography.
// ";


// $vararray= explode(" ", $variable);

// $size=sizeof($vararray);

// for ($i=0; $i < $size; $i+=13) { 

// 	$tocheck="";

// 	for ($j=1; $j <=13 ; $j++) { 
// 		if($i+$j<$size){
// 			$tocheck=$tocheck.$vararray[$i+$j];
// 		}
// 	}
	
// 	$res=searchonline($tocheck);

// 	if($res[2]>=55){
// 		echo $res[2];
// 		echo $res[1];
//   		echo $res[0];


// 	}
// 	else{
// 		echo "Good";

// 	}

// }
error_reporting(E_ERROR | E_PARSE);
print_r(searchonline($getinput));

// print_r(searchonline("A look at that genome has revealed curious things, said Pat Heslop-Harrison, a plant "));

// print_r(searchonline("1. Robert Capa is a name that has for many years been synonymous with war photography."));
// print_r(searchonline("3. In 1936, after the breakout of the Spanish Civil war, Capa went to Spain and it was here over the next three years that he built his reputation "));
// print_r(searchonline("The Reading Comprehension section contains reading passages and questions about the passages. The questions are "));
// print_r(searchonline("Our education and career-based site and advertising hub lists educators (schools, institutes, colleges and universities) in the U.S."));

}
?>