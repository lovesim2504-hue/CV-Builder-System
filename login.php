
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login - MyResumeBuilder</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	  <header>
    <nav class="navbar">
      <div class="logo">MyResume<span>Builder</span></div>
      <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>
	<div class="login-container">
		<form method="POST" action="preview1.php" name="form1">
			<h2>Login</h2> <br>
			<input type="text" name="em" placeholder="Username" required><br><br>
			<input type="password" name="pass" placeholder="Password" required><br><br>
			<button type="submit" name="btn" class="btn">Login</button>
		</form>
		<?php if (isset($error)) echo "<p style='color:red; text-align:center; margin-top:10px; ' >$error</p>"; ?>
	</div>
  <footer>
    <p>© 2025 MyResumeBuilder. All rights reserved.</p>
  </footer>
</body>

</html>