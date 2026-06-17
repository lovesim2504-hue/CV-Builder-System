<?php
// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$skills = $_POST['skills'];
$hobbies = $_POST['hobbies'];
$objective = $_POST['objective'];
?>

<html>
<head>
<title>Resume Preview</title>
<link rel="stylesheet" href="style.css">
<style>
body {font-family: Arial, sans-serif; margin:0; padding:20px; background:#f8eae2;}
.container {max-width:800px; margin:auto; background:white; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);}
h1, h2, h3 {text-align:center;}
section {margin-top:15px;}
button{margin-top:25px; display:block; padding:12px 25px; border:none; background:#DCAE96; font-size:18px; color:white; border-radius:5px; cursor:pointer; margin-left:auto; margin-right:auto;}
button:hover{background:#0056b3;}
</style>
</head>
<body>
<div class="container">
  <h1><?php echo htmlspecialchars($name); ?></h1>
  <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
  <p><b>Contact:</b> <?php echo htmlspecialchars($contact); ?></p>

  <section>
    <h3>Qualification</h3>
    <p><?php echo nl2br(htmlspecialchars($qualification)); ?></p>
  </section>

  <section>
    <h3>Experience</h3>
    <p><?php echo nl2br(htmlspecialchars($experience)); ?></p>
  </section>

  <section>
    <h3>Skills</h3>
    <p><?php echo nl2br(htmlspecialchars($skills)); ?></p>
  </section>

  <?php if (!empty($hobbies)) { ?>
  <section>
    <h3>Hobbies</h3>
    <p><?php echo nl2br(htmlspecialchars($hobbies)); ?></p>
  </section>
  <?php } ?>

  <?php if (!empty($objective)) { ?>
  <section>
    <h3>Objective / Goals</h3>
    <p><?php echo nl2br(htmlspecialchars($objective)); ?></p>
  </section>
  <?php } ?>

  <form method="POST" action="resume.php" target="_blank">
    <!-- Send same data to generate PDF -->
    <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <input type="hidden" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
    <input type="hidden" name="qualification" value="<?php echo htmlspecialchars($qualification); ?>">
    <input type="hidden" name="experience" value="<?php echo htmlspecialchars($experience); ?>">
    <input type="hidden" name="skills" value="<?php echo htmlspecialchars($skills); ?>">
    <input type="hidden" name="hobbies" value="<?php echo htmlspecialchars($hobbies); ?>">
    <input type="hidden" name="objective" value="<?php echo htmlspecialchars($objective); ?>">
    <button type="submit">Download as PDF</button>
  </form>
</div>
</body>
</html>
