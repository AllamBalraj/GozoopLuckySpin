<!DOCTYPE html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="css/loginpage_style.css">
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login to play Gozoop spin.</h1>
      <form method="post" action="login_check.php" name="login_form">

        <p><input type="text" name="email" value="" placeholder="email" required></p>
        <p><input type="password" name="password" value="" placeholder="Password" required></p>

        <p class="submit"><a href="signup.php">Sign up?</a>  <input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

  </section>

</body>
</html>