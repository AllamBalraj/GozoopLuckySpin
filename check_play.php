<?php

require 'Carbon/Carbon.php';
use Carbon\Carbon;

include 'db_connect.php';
if (isset($_POST['id']) && !empty($_POST['id'])) {
	# code...
	$uid = $_POST['id'];
	$points = 0;

	if (isset($_POST['play_points'])) {
		$points = $_POST['play_points'];
	}
	
	$query = "SELECT play_attempts,points FROM users WHERE id=".$uid;

	$execute = mysqli_query($con,$query)
	or die('play attempt query not executed');

	$row = mysqli_fetch_array($execute);

	$no_of_attemps = $row['play_attempts'];
	$points += $row['points'];


	if ($no_of_attemps < 3) {
		$no_of_attemps += 1;
		$update_attempts = "UPDATE users SET play_attempts=". $no_of_attemps .",last_played='".Carbon::now()."',points=".$points." WHERE id=".$uid;

		mysqli_query($con,$update_attempts)
		or die("update play attempts not execued");
	}

	$data = array(
		'no_of_attemps' => $no_of_attemps,
		'points' => $points);

	echo json_encode($data);
}

?>