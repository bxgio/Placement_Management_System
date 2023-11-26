<?php
include("../database/db.php");
// include("../alert.php");
session_start();  
if(!isset($_SESSION['id']))
{
  header('location:login.php');
}

if(isset($_POST['submit']))
{
    $id = $_SESSION['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $details = $_POST['details'];
    $vacancy = $_POST['vacancy'];
    $title = $_POST['title'];
    $qualification = $_POST['qualification'];
    $lastdate = $_POST['lastdate'];
    $s = "UPDATE newplacement SET name='$name',title='$title',qualification='$qualification',location='$location',contact='$contact',details='$details',vacancy='$vacancy',lastdate='$lastdate' WHERE id= '$id'";
    if(mysqli_query($con,$s))
    {
        echo "<script>alert('Updated')</script>";
        
    }
    else{
        echo "<script>alert('Not Updated')</script>";
    
    }
}
