<?php
include("../database/db.php");
session_start();
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $title = $_POST['title'];
    $qualification = $_POST['qualification'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $details = $_POST['details'];
    $vacancy = $_POST['vacancy'];
    $lastdate = $_POST['lastdate'];
    $s = "INSERT INTO newplacement(name,title, qualification,location,contact, details, vacancy,lastdate) VALUES ('$name','$title','$qualification','$location','$contact','$details','$vacancy','$lastdate')";
    if (mysqli_query($con, $s)) {
        echo "<script>alert('Successfully Added'); window.location='../companydetails.php';</script>";
    } else {
        echo "<script>alert('Not added ');window.location='../newplacement.php';</script>";
    }
}
