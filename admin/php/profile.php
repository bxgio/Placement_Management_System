<?php
include("../database/db.php");
session_start();

$select = "SELECT * FROM users WHERE id='$id'";
$reg = mysqli_query($con,$select);
$fetch = mysqli_fetch_array($reg);
$id = $fetch['id'];
if(isset($_POST['submit']))
{

    $name = $_POST['name'];
    $dno = $_POST['dno'];
    $major = $_POST['major'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    $skills = $_POST['skills'];
    $sslc = $_POST['10th'];
    $hsc = $_POST['12th'];
    $one = $_POST['1st'];
    $two = $_POST['2nd'];
    $three = $_POST['3rd'];
    $four = $_POST['4th'];
    $five = $_POST['5th'];
    $six = $_POST['6th'];
    $s = "INSERT INTO studentdetail(id, major, phone, email, degree, year, skill, 10th, 12th, 1st, 2nd, 3rd, 4th, 5th, 6th) VALUES ('$id','$major',$phone,'$email','$degree','$year','$skills',$sslc,$hsc,'$one','$two','$three','$four','$five', '$six')";

    if(mysqli_query($con,$s))
    {
        echo "<script>alert('profile added Successfully'); window.location='../../user/user_home.php';</script>";
    }
    else{
        echo "<script>alert('Not added'); window.location='../../user/profile.php';</script>";
    }
}
?>