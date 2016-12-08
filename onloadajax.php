<?php

require 'Carbon/Carbon.php';
use Carbon\Carbon;

include 'db_connect.php';
if (isset($_POST['id']) && !empty($_POST['id'])) {
	# code...
	$uid = $_POST['id'];
	
	$query = "SELECT play_attempts,last_played,points FROM users WHERE id=".$uid;

	$execute = mysqli_query($con,$query)
	or die('play attempt query not executed');

	$row = mysqli_fetch_array($execute);

	$no_of_attemps = $row['play_attempts'];
	$points = $row['points'];

	//check if 30 minutes are over, then update last played and set play_attempt to 0.
	if ($no_of_attemps >= 3) {
		$last_played = new Carbon($row['last_played']);

		if (Carbon::now()->diffInMinutes($last_played) > 30) {
			$update_last_played = "UPDATE users SET last_played = NULL, play_attempts = 0 WHERE id = ".$uid;

			mysqli_query($con,$update_last_played)
			or die('Update last login failed');

			$no_of_attemps = 0;
		}
	}

	$data = array(
		'no_of_attemps' => $no_of_attemps,
		'points' => $points);
	// echo $no_of_attemps;

	echo json_encode($data);
}

?>