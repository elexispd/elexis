<?php 
date_default_timezone_set('Africa/Lagos');
// echo timestamp('2021-08-08 10:46');


function timestamp($timestamp){
	$time_ago = strtotime($timestamp);
	$current_time = time();
	$time_difference = $current_time - $time_ago;
	$seconds = $time_difference;
	$minutes = round($seconds/60);

	if ($seconds <=60) {
		return "Just Now";
	} else if($minutes <=60){
		if ($minutes == 1) {
			return "A minute ago";
		} else{
			if ($minutes >12 ) {
				$m = "AM";
			} else{
				$m="PM";
			}
			return "some minutes ago";
		}
	} else{
		return substr($timestamp, strrpos($timestamp, " ")) ;
	}
}

$time1 = new DateTime();
$time2 = new DateTime('2021-08-8 22:47');
$i = $time1 ->diff($time2);
$e = $i->format('%i');
echo $e;
