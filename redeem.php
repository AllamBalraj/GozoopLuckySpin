<?php

require 'Carbon/Carbon.php';
use Carbon\Carbon;

include 'db_connect.php';
if (isset($_POST['id']) && !empty($_POST['id'])) {

	$uid = $_POST['id'];
	$redeem_points = 0;

	if (isset($_POST['redeem_points'])) {
		$redeem_points = $_POST['redeem_points'];
	}
	
	$query = "SELECT points FROM users WHERE id=".$uid;

	$execute = mysqli_query($con,$query)
	or die('redeem attempt query not executed');

	$row = mysqli_fetch_array($execute);

	if ($row['points'] >= $redeem_points) {
		
		$redeemed_points = $row['points'] - $redeem_points;

		$update_attempts = "UPDATE users SET points=".$redeemed_points." WHERE id=".$uid;

		mysqli_query($con,$update_attempts)
		or die("update play attempts not execued");

		$response = array(
			'status' => 'success',
			'remaining_points' => $redeemed_points);
		
		echo json_encode($response);

	}else{
		$response = array('status' => 'failed'); 
		echo json_encode($response);
	}
}

?>