<?php
require_once '../dbvars.php';
require_once '../dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM resumes WHERE id=$id");
$row = $res->fetch_assoc();
$conn->close();

$html = "
<h1 style='text-align:center;'>{$row['name']}</h1>
<p style='text-align:center;'>{$row['email']} | {$row['contact']}</p>
<h3>Objective</h3>
<p>".nl2br($row['objective'])."</p>
<h3>Education</h3>
<table border='1' width='100%' cellpadding='6'>
<tr><th>Degree</th><th>Institution</th><th>Year</th></tr>";

$qualifications = explode("\n", $row['qualification']);
foreach ($qualifications as $qual) {
  $parts = array_map('trim', explode(",", $qual));
  if (count($parts) === 3) {
    $html .= "<tr><td>{$parts[0]}</td><td>{$parts[1]}</td><td>{$parts[2]}</td></tr>";
  }
}

$html .= "</table>
<h3>Experience</h3>
<p>".nl2br($row['experience'])."</p>
<h3>Skills</h3><ul>";

foreach (array_filter(array_map('trim', explode("\n", $row['skills']))) as $s)
  $html .= "<li>{$s}</li>";

$html .= "</ul><h3>Hobbies</h3><ul>";

foreach (array_filter(array_map('trim', explode("\n", $row['hobbies']))) as $h)
  $html .= "<li>{$h}</li>";

$html .= "</ul>";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("resume_{$row['name']}.pdf", ["Attachment" => true]);
?>
