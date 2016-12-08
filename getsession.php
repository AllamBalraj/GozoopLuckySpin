<?php

session_start();

if(!isset($_SESSION['uid'])){
	# code...
	echo $_SESSION['uid'];
}