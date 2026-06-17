<?php
$msg = ''; // Initialize message variable

if (isset($_POST["btn"])) {
    require_once("dbvars.php"); // Includes your existing connection ($conn)

    $pn = trim($_POST["pname"]);
    $phone = trim($_POST["ph"]);
    $email = trim($_POST["em"]);
    $passw = $_POST["pass"];
    $cpassw = $_POST["cpass"];

    if ($passw === $cpassw) {
        // Hash password securely
        $hashedPass = password_hash($passw, PASSWORD_DEFAULT);

        // Use prepared statement
        $stmt = $conn->prepare("INSERT INTO register (pname, ph, em, pass) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $pn, $phone, $email, $hashedPass);

        if ($stmt->execute()) {
            $msg = "✅ Registration successful!";
        } else {
            $msg = "❌ Error: Unable to register. " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        $msg = "⚠️ Password and confirm password do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - MyResumeBuilder</title>
 <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- HEADER -->
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

    <!-- FORM -->
    <div class="login-container frm">
        <form method="POST" action="" class="frm">
            <h2>Register</h2> <br><br>
            <input type="text" name="pname" placeholder="Full Name" required> <br><br>
            <input type="tel" name="ph" placeholder="Phone Number" required> <br> <br>
            <input type="email" name="em" placeholder="Email Address" required> <br> <br>
            <input type="password" name="pass" placeholder="Password" required> <br> <br>
            <input type="password" name="cpass" placeholder="Confirm Password" required> <br><br>
            <button type="submit" name="btn" class="btn">Register</button>

            <?php if (!empty($msg)): ?>
                <p class="msg <?php echo (strpos($msg, 'successful') !== false) ? 'success' : 'error'; ?>">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>
        </form>
    </div>

    <!-- FOOTER -->
    <footer>
        <p>© 2025 MyResumeBuilder. All rights reserved.</p>
    </footer>
</body>
</html>
