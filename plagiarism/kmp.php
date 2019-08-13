<?php
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

$string1="From: Mounika
To: Hasmitha
CC: Arun
Subject: Arun, meet Hasmitha. Hasmitha meet Arun
Arun I want to introduce you to Hasmitha. She's been working in a company for 2 years. And I know you are looking for good developer. She is a strong content developer. She is good in her skills and punctual in the tasks assigned to her.  And she is going to get married in Bombay next month, and she is also looking for a better job there. 
Hasmitha, Arun is a team manager in AccerInc, Bombay. and he is looking for a content developer. He is a very much talented and leads the team very well.
I made this to your view so that both of you can be mutually benefited. Hope this can add advantage to both of you.
Hasmitha-will you follow up with Arun over email to set up a phone call? 

Thanks,
-Mounika
";

$string2="From:N.Arun kumar
To:  Hasmitha
Cc: Mr.Arun
Subject :Arun, meet Hasmitha . Hasmitha, meet Arun.

Arun, I want to introduce you to Hashmitha. She is an efficient content developer and has a experience of 10 years. She has worked in  Tech Mahindra and Cognizant. She is one of the member who developed the software for the suggestion that we get in Google search engine . She is a good friend of mine. Hashmita I want  to introduce you to Arun. He is working in MindSpace  for 14 years. He is the project manager, HR and he has undertaken many projects in the company.He is good at developing  application software.
You both grew up in Hyderabad and now based on Mumbai.
Arun – will you follow up with Hashmita over email to setup a phone call?
Thanks,
N.Arun kumar";


$string1 = preg_replace('!\s+!', ' ', $string1);
$string2 = preg_replace('!\s+!', ' ', $string2);

$string1=str_replace(". ", ".", $string1);
$string2=str_replace(". ", ".", $string2);




$arr = explode(" ", $string2);

$totalwords=sizeof($arr);


$farray=array();
for ($i=0; $i < sizeof($arr)-2 ; $i++) { 

	if(sizeof(SearchString($string1,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]))>0){
		array_push($farray,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]);
	}else{

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



echo($tempstr);


$wordcount=0;
foreach ($sentences as $counter) {
	$wordcount+=sizeof(explode(" ", $counter));
}


?>


<br>
<br>
<br>

<?php 
echo($wordcount/$totalwords*100);
  ?>