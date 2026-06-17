<?php
require_once '../dbvars.php';
$id=$_GET['id'];
$res=$conn->query("SELECT * FROM resumes WHERE id=$id");
$row=$res->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sidebar Resume</title>
<style>
body{margin:0;font-family:'Poppins',sans-serif;background:#f5f6f7;}
.container{display:flex;max-width:950px;margin:40px auto;background:#fff;box-shadow:0 8px 20px rgba(0,0,0,0.1);}
.sidebar{background:#A67B5B;color:#fff;width:30%;padding:40px;}
.sidebar img{width:120px;height:120px;border-radius:50%;display:block;margin:auto;border:3px solid #fff;}
.sidebar h2{text-align:center;margin-top:15px;}
.sidebar ul{list-style:none;padding-left:0;}
.sidebar ul li{margin-bottom:10px;}
.main{flex:1;padding:40px;}
.main h2{color:#A67B5B;border-bottom:2px solid #eee;}
table{width:100%;border-collapse:collapse;margin-top:10px;}
th,td{border:1px solid #ccc;padding:8px;}
</style>
</head>
<body>

<div class="container">
  <div class="sidebar">
    <?php if($row['image']): ?><img src="../uploads/<?php echo $row['image']; ?>"><?php endif; ?>
    <h2><?php echo $row['name']; ?></h2>
    <p><?php echo $row['email']; ?><br><?php echo $row['contact']; ?></p>
    <h3>Skills</h3>
    <ul><?php foreach(explode("\n",$row['skills']) as $s) echo "<li>$s</li>"; ?></ul>
    <h3>Hobbies</h3>
    <ul><?php foreach(explode("\n",$row['hobbies']) as $h) echo "<li>$h</li>"; ?></ul>
  </div>

  <div class="main">
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
