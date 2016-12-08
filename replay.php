<?php

require 'Carbon/Carbon.php';
use Carbon\Carbon;

include 'db_connect.php';
if (isset($_POST['id']) && !empty($_POST['id'])) {
	# code...
	$uid = $_POST['id'];
	
	$query = "SELECT last_played FROM users WHERE id=".$uid;

	$execute = mysqli_query($con,$query)
	or die('play attempt query not executed');

	$row = mysqli_fetch_array($execute);

	$last_played = new Carbon($row['last_played']);

	if (Carbon::now()->diffInMinutes($last_played) > 30) {
		echo 1;
	}else{
		echo 0;
	}
}

?>