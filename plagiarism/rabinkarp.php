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

$string1="From:N.Arun kumar To: Hasmitha Cc: Mr.Arun Subject :Arun, meet Hasmitha . Hasmitha, meet Arun. Arun, I want to introduce you to Hashmitha. She is an efficient content developer and has a experience of 10 years. She has worked in Tech Mahindra and Cognizant. She is one of the member who developed the software for the suggestion that we get in Google search engine. She is a good friend of mine. Hashmita, I want to introduce you to Arun. He is working in MindSpace for 14 years. He is the project manager, HR and he has undertaken many projects in the company.He is good at developing application software. You both grew up in Hyderabad and now based on Mumbai. Arun – will you follow up with Hashmita over email to setup a phone call? Thanks, N.Arun kumar";

$string2="From: Manikanta To: Hasmithais Cc: Arun Subject: Arun, meet Hasmithais. Hasmithais, meet Arun. Arun, I want to introduce you to Hasmithais. She is a good, efficient, content developer and has an experience of 10 years and I know you are looking for a content developer. She has worked in IBM and Microsoft. She is one of the member who developed the software for the suggestion that we get in Google search engine. She is one of my good friend. Hasmithais, I want to introduce you to Arun. He is working in Mind tree company for 12 years. He is the project manager and he has taken on many projects in the company. He is good at developing Android application. You both grew up in Hyderabad and now based on Mumbai. Arun – will you follow up with Hasmithais over email to setup a phone call? Thanks and Regards, Manikanta";



// print_r(SearchString($data,"the"));

$arr = explode(" ", $string2);

print_r($arr);
?><br> <?php

$farray=array();
// print_r($arr);
for ($i=0; $i < sizeof($arr)-2 ; $i++) { 
	// $temp=;
	// echo $arr[1];

	if(sizeof(SearchString($string1,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]))>0){
		// echo ();
		// $temp1=$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2];
		// $farray.push($arr[$i]);
		// $farray.push($arr[$i+1]);
		// $farray.push($arr[$i+2]);
		array_push($farray,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]);
		// array_push($farray,array($arr[$i],$arr[$i+1],$arr[$i+2]));
		$i+=1;
	}else{
		// array_push($farray,$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]);

	}
	// else{
	// 	// echo "string    "+$arr[$i]+" "+$arr[$i+1]+" "+$arr[$i+2]+"      ";
	// 	// echo ("String   ".$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2]." ");

	// }
}

// print_r($farray);

$sentences=array();
$tempvar=$farray[0];

for ($i=1; $i < sizeof($farray) ; $i++) { 
	$exist=explode(" ", trim($tempvar));

	print_r($exist);
?><br> <?php

	$fary=explode(" ", trim($farray[$i]));
print_r($fary);
?><br> <?php

	// print_r($exist);
	// print_r("expression");
	// print_r($fary);

	if (trim($exist[sizeof($exist)-1])===trim($fary[0])) {
		$tempvar=$tempvar." ".$fary[1]." ".$fary[2];
	}
	else{
		array_push($sentences, trim($tempvar));
		$tempvar=$farray[$i];
	}
}

print_r($sentences);

// $temsen=$farray[0];
// for ($i=1; $i < sizeof($farray)-1 ; $i++) { 
// 	$tempexp=explode(" ", $temsen);
// 	$tempexp2=explode(" ", $farray[$i]);
// 	if($tempexp[sizeof($tempexp)-1]==$tempexp2[0]){
// 		$temsen=$temsen." ".$tempexp2[$i][1]." ".$farray[$i][2];
// 	}
// 	else{
// 		array_push($sentences, $temsen);
// 	}
// }
// print_r($sentences);

?>
