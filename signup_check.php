<?php 
require_once 'db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['confirm_password'];

$response = array();
if (!empty($email) && !empty($password) && !empty($cpassword)) {
	if ($password == $cpassword) {
		$query = "SELECT * FROM users WHERE email LIKE '".$email."'";
		$exec = mysqli_query($con, $query)
		or die('mysqli query not executed');

		if(mysqli_num_rows($exec)==0){
			$ins = "INSERT INTO users(email,password) VALUES ('$email',SHA('$password'))";
			mysqli_query($con,$ins)
			or die('insert query not executed');

			echo "Registered Successfull.";

			echo '<br><a href="login.php">Go to login.</a>';
		}
		else
		{
			echo "user exist";
		}
	}else{
		echo "Password and Confirm Password should be same.";
	}
}
?>