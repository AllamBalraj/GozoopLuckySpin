<!DOCTYPE html>
<head>
	<title>Signup Form</title>
	<link rel="stylesheet" href="css/loginpage_style.css">
</head>
<body>

	<section class="container">
		<div class="login">
			<h1>Signup</h1>
			<form name="admin" method="post" action="signup_check.php">

				<p><input type="text" name="email" placeholder="abcd@def.com" required/></p>
				<p><input type="password" name="password" placeholder="password" required/></p>
				<p><input type="password" name="confirm_password" placeholder="confirm password" required/></p>

				<p class="submit"><a href="login.php">Login?</a>  <input type="submit" name="submit" value="Signup" /></p>
			</form>
		</div>

	</section>
</body>
</html>