<?php

require 'Carbon/Carbon.php';
use Carbon\Carbon;

include 'db_connect.php';

$uname = $_POST['email'];
$pass = $_POST['password'];

if(!isset($_POST['commit']))
{
 echo 'The page you are looking for does not exist';
}
if(!isset($_SESSION['uid']))
{
  if(isset($_POST['commit']))
  {
    if(!empty($uname) && !empty($pass))
    {
      $query = "select * from users WHERE email='$uname' AND password=SHA('$pass')";
      $data = mysqli_query($con, $query)
      or die('Select Query not executed');

      if(mysqli_num_rows($data)==1)
      {
        $row = mysqli_fetch_array($data);
        session_start();

        $_SESSION['uid'] = $row['id'];
        $_SESSION['uname'] = $row['email'];

        header('Location:index.php');
      }
      else
      {
        echo 'No Such User Found';
        echo '<br><a href="signup.php">SignUp Here.</a>';
      }
    }

  }
}

?>