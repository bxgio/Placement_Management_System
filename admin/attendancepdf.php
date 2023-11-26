<?php
include("./database/db.php");
require '../dompdf/vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
$course = mysqli_query($con, "SELECT * FROM studentdetail");
// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('attendance.php');
$html=ob_get_contents();
ob_get_clean();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Attendance_sheet.pdf');
