<?php
include("database/db.php");
session_start();


if(isset($_POST['submit']))
{
    $a = $_POST['email'];
    $b = $_POST['password'];

    $s = "select * from users where dno='$a' and pass='$b'";
    $sel = mysqli_query($con,$s);
    $rows = mysqli_num_rows($sel);
    
    if($rows==1)
    {
        $data = mysqli_fetch_array($sel);
        $_SESSION['id'] = $data['id'];
        header("location:user_home.php");
    }
    else
    {
    echo "<script>alert('Invalid Password OR User does not exists')</script>";
	echo "<script>window.location='login.php'</script>";
    }
}
