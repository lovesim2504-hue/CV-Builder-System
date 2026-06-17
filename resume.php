<?php
require 'dompdf/vendor/autoload.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        color: #4A4A4A; /* Soft gray for text */
        background-color: #FAF9F6; /* Off-white background */
        margin: 0;
        padding: 20px;
        line-height: 1.6;
    }
    h1 {
        color: #8B7355; /* Nude brown for name */
        text-align: center;
        margin-bottom: 20px;
        font-size: 28px;
        border-bottom: 2px solid #D2B48C; /* Light tan underline */
        padding-bottom: 10px;
    }
    p {
        margin: 10px 0;
    }
    h3 {
        color: #A0522D; /* Sienna for section headings */
        margin-top: 30px;
        margin-bottom: 10px;
        font-size: 20px;
        border-left: 4px solid #DEB887; /* Burlywood left border */
        padding-left: 10px;
    }
    .contact-info {
        text-align: center;
        margin-bottom: 20px;
    }
    .contact-info b {
        color: #8B7355; /* Nude brown for labels */
    }
    .section-content {
        background-color: #FFF8DC; /* Cream background for sections */
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
<h1>' . $_POST['name'] . '</h1>
<div class="contact-info">
    <p><b>Email:</b> ' . $_POST['email'] . '</p>
    <p><b>Contact:</b> ' . $_POST['contact'] . '</p>
</div>
<h3>Qualification</h3>
<div class="section-content"><p>' . nl2br($_POST['qualification']) . '</p></div>
<h3>Experience</h3>
<div class="section-content"><p>' . nl2br($_POST['experience']) . '</p></div>
<h3>Skills</h3>
<div class="section-content"><p>' . nl2br($_POST['skills']) . '</p></div>
<h3>Hobbies</h3>
<div class="section-content"><p>' . nl2br($_POST['hobbies']) . '</p></div>
<h3>Objective / Goals</h3>
<div class="section-content"><p>' . nl2br($_POST['objective']) . '</p></div>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Resume.pdf", ["Attachment" => true]);
?>
