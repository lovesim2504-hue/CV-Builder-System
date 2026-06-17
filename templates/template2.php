<?php
require_once '../dbvars.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM resumes WHERE id=$id");
$row = $res->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Modern Resume</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f3f4f6;
  margin: 0;
  padding: 40px;
}
.container {
  background: white;
  max-width: 900px;
  margin: auto;
  border-radius: 12px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  overflow: hidden;
}
.header {
  background: linear-gradient(135deg, #DCAE96, #A67B5B);
  color: white;
  padding: 40px;
  display: flex;
  align-items: center;
}
.header img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 25px;
  border: 4px solid white;
}
.header h1 {
  font-size: 36px;
  margin-bottom: 8px;
}
.header p {
  margin: 3px 0;
}
.content {
  display: flex;
  padding: 30px;
}
.left, .right {
  flex: 1;
  padding: 20px;
}
.left {
  border-right: 2px solid #eee;
}
h2 {
  border-bottom: 2px solid #DCAE96;
  padding-bottom: 5px;
  margin-bottom: 10px;
  color: #A67B5B;
}
ul { padding-left: 20px; }
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  padding: 8px;
  border-bottom: 1px solid #ddd;
}
</style>
</head>
<body>

<div class="container">
  <div class="header">
    
    <?php if(!empty($row['profile_image'])): ?>
      <img src="../uploads/<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Profile">
    <?php endif; ?>
    <div>
      <h1><?php echo htmlspecialchars($row['name']); ?></h1>
      <p><?php echo htmlspecialchars($row['email']); ?> | <?php echo htmlspecialchars($row['contact']); ?></p>
      <p><strong>Objective:</strong> <?php echo htmlspecialchars($row['objective']); ?></p>
    </div>
  </div>

  <div class="content">
    <div class="left">
      <h2>Education</h2>
      <table>
        <tr><th>Degree</th><th>Institution</th><th>Year</th></tr>
        <?php
        $q = explode("\n", $row['qualification']);
        foreach ($q as $qual) {
          $p = array_map('trim', explode(",", $qual));
          if(count($p)==3)
            echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
        }
        ?>
      </table>

      <h2>Experience</h2>
      <p><?php echo nl2br(htmlspecialchars($row['experience'])); ?></p>
    </div>

    <div class="right">
      <h2>Skills</h2>
      <ul>
        <?php foreach(array_filter(explode("\n", $row['skills'])) as $s) echo "<li>$s</li>"; ?>
      </ul>

      <h2>Hobbies</h2>
      <ul>
        <?php foreach(array_filter(explode("\n", $row['hobbies'])) as $h) echo "<li>$h</li>"; ?>
      </ul>
    </div>
  </div>
  
</div>
<div style="text-align:center; margin-top:20px;">
  <a href="download_pdf.php?id=<?php echo $id; ?>" 
     style="background:#A67B5B; color:white; padding:12px 25px; text-decoration:none; border-radius:6px; font-weight:500;">
     ⬇️ Download PDF
  </a>
</div>
</body>
</html>
