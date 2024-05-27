<?php

//GET TIME AGO FUNCTION
function TimeAgo($oldTime, $newTime) {
$timeCalc = strtotime($newTime) - strtotime($oldTime);
if ($timeCalc >= (60*60*24*30*12*2)){
	$timeCalc = intval($timeCalc/60/60/24/30/12) . " منذ أعوام";
	}else if ($timeCalc >= (60*60*24*30*12)){
		$timeCalc = intval($timeCalc/60/60/24/30/12) . " منذ عام ";
	}else if ($timeCalc >= (60*60*24*30*2)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " منذ أشهر ";
	}else if ($timeCalc >= (60*60*24*30)){
		$timeCalc = intval($timeCalc/60/60/24/30) . " منذ شهر ";
	}else if ($timeCalc >= (60*60*24*2)){
		$timeCalc = intval($timeCalc/60/60/24) . " منذ يوم";
	}else if ($timeCalc >= (60*60*24)){
		$timeCalc = " أمس";
	}else if ($timeCalc >= (60*60*2)){
		$timeCalc = intval($timeCalc/60/60) . "منذ ساعات";
	}else if ($timeCalc >= (60*60)){
		$timeCalc = intval($timeCalc/60/60) . " منذ ساعة";
	}else if ($timeCalc >= 60*2){
		$timeCalc = intval($timeCalc/60) . "منذ دقائق";
	}else if ($timeCalc >= 60){
		$timeCalc = intval($timeCalc/60) . " منذ دقيقة";
	}else if ($timeCalc > 0){
		$timeCalc .= "منذ ثوان ";
	}
return $timeCalc;
}

//echo TimeAgo($date, date("Y-m-d H:i:s"));
