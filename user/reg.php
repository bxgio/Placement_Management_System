<?php
include("database/db.php");
session_start();

if(isset($_POST['submit']))
{
$a = $_POST['username'];
$b = $_POST['email'];
$c = $_POST['password'];

$check = "SELECT * FROM users WHERE name='$a' OR dno='$b'";
$reg = mysqli_query($con,$check);
$row=mysqli_num_rows($reg);
if($row==0)
{
    $s = "INSERT INTO users(`name`, `dno`, `pass`) VALUES ('$a','$b','$c')";
    if(mysqli_query($con,$s))
    {
        echo "<script>alert('Your registration is successfully completed.');window.location='login.php';</script>";
    }
    else
    {
        echo "<script>alert('Connection failed. please try again.');window.location='register.php';</script>";
    }  

}
else{
    echo "<script>alert('This Username or Email ID already exisits');window.location='register.php';</script>";
}

}
else{
    header("location:register.php");
}
