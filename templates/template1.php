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
<title>Minimal Resume</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  color: #222;
  background: #f8f9fa;
  margin: 0;
  padding: 40px;
}
.container {
  background: #fff;
  max-width: 850px;
  margin: auto;
  padding: 40px 50px;
  border-radius: 12px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  position: relative;
}
.download-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  background: #DCAE96;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}
.download-btn:hover {
  background: #A67B5B;
}
.header {
  text-align: center;
  border-bottom: 3px solid #DCAE96;
  padding-bottom: 15px;
  margin-bottom: 25px;
}
h1 {
  font-size: 36px;
  color: #111;
  margin-bottom: 5px;
}
.contact {
  color: #555;
  font-size: 16px;
}
h2 {
  margin-top: 35px;
  color: #DCAE96;
  border-bottom: 2px solid #ddd;
  padding-bottom: 5px;
}
p {
  line-height: 1.6;
  font-size: 16px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
table, th, td {
  border: 1px solid #ccc;
}
th, td {
  padding: 10px;
  text-align: left;
  font-size: 15px;
}
th {
  background-color: #f4f4f4;
  color: #333;
}
ul {
  margin-top: 8px;
  padding-left: 25px;
}
ul li {
  margin-bottom: 6px;
}
</style>
</head>
<body>

<div class="container">
 

  <div class="header">
    <h1><?php echo htmlspecialchars($row['name']); ?></h1>
    <p class="contact">
      📧 <?php echo htmlspecialchars($row['email']); ?> &nbsp; | &nbsp; ☎️ <?php echo htmlspecialchars($row['contact']); ?>
    </p>
  </div>

  <h2>🎯 Objective</h2>
  <p><?php echo nl2br(htmlspecialchars($row['objective'])); ?></p>

  <h2>🎓 Education</h2>
  <table>
    <tr><th>Degree</th><th>Institution</th><th>Year</th></tr>
    <?php
    $qualifications = explode("\n", $row['qualification']);
    foreach ($qualifications as $qual) {
        $parts = array_map('trim', explode(",", $qual));
        if (count($parts) === 3) {
            echo "<tr>
                    <td>".htmlspecialchars($parts[0])."</td>
                    <td>".htmlspecialchars($parts[1])."</td>
                    <td>".htmlspecialchars($parts[2])."</td>
                  </tr>";
        }
    }
    ?>
  </table>

  <h2>💼 Experience</h2>
  <p><?php echo nl2br(htmlspecialchars($row['experience'])); ?></p>

  <h2>🧠 Skills</h2>
  <ul>
    <?php
    foreach (array_filter(array_map('trim', explode("\n", $row['skills']))) as $s)
        echo "<li>".htmlspecialchars($s)."</li>";
    ?>
  </ul>

  <h2>🎨 Hobbies</h2>
  <ul>
    <?php
    foreach (array_filter(array_map('trim', explode("\n", $row['hobbies']))) as $h)
        echo "<li>".htmlspecialchars($h)."</li>";
    ?>
  </ul>
</div>
<div style="text-align:center; margin-top:20px;">
  <a href="download_pdf.php?id=<?php echo $id; ?>" 
     style="background:#A67B5B; color:white; padding:12px 25px; text-decoration:none; border-radius:6px; font-weight:500;">
     ⬇️ Download PDF
  </a>
</div>
</body>
</html>
