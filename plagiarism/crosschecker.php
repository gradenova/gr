<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$string1=$_REQUEST['source'];
$string2=$_REQUEST['target'];


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

$percent=($wordcount/strlen($string2))*100;

$finalres=Highlight($sentences,$string1)."kallaklakkal".Highlight($sentences,$string2)."kallaklakkal".$percent;
// return $= array('' => , );

echo $finalres;


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