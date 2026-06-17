<?php
require_once '../dbvars.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM resumes WHERE id=$id");
$row = $res->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Modern Resume 2</title>
<style>
body {font-family:'Poppins',sans-serif; background:#f4f6f8; margin:0; padding:40px;}
.container {
  background:#fff; max-width:850px; margin:auto; border-radius:10px; overflow:hidden;
  box-shadow:0 8px 25px rgba(0,0,0,0.1);
}
.header {
  text-align:center;
  background:#A67B5B;
  color:#fff;
  padding:40px;
}
.header img {
  width:120px;
  height:120px;
  border-radius:50%;
  border:4px solid #fff;
}
h1 {margin:10px 0;}
.section {padding:30px 50px;}
.section h2 {color:#A67B5B; border-bottom:2px solid #eee;}
ul {padding-left:25px;}
table {width:100%; border-collapse:collapse; margin-top:10px;}
th,td{border:1px solid #ddd; padding:8px;}
th{background:#f9f9f9;}
</style>
</head>
<body>

<div class="container">
  <div class="header">
    <?php if($row['image']): ?><img src="../uploads/<?php echo $row['image']; ?>"><?php endif; ?>
    <h1><?php echo $row['name']; ?></h1>
    <p><?php echo $row['email']; ?> | <?php echo $row['contact']; ?></p>
  </div>

  <div class="section">
    <h2>Objective</h2>
    <p><?php echo nl2br($row['objective']); ?></p>

    <h2>Education</h2>
    <table>
      <tr><th>Degree</th><th>Institution</th><th>Year</th></tr>
      <?php
      foreach(explode("\n",$row['qualification']) as $q){
        $p=explode(",",$q);
        if(count($p)==3) echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
    </table>

    <h2>Experience</h2>
    <p><?php echo nl2br($row['experience']); ?></p>

    <h2>Skills</h2>
    <ul><?php foreach(explode("\n",$row['skills']) as $s) echo "<li>$s</li>"; ?></ul>

    <h2>Hobbies</h2>
    <ul><?php foreach(explode("\n",$row['hobbies']) as $h) echo "<li>$h</li>"; ?></ul>
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
