<?php
session_start();
$con=mysqli_connect("localhost","root","","login");

if (isset($_POST['submit'])) {
  $a = $_POST['username'];
  $b = $_POST['password'];

  $s = "SELECT * FROM login WHERE username='$a' AND password='$b'";
  $sel = mysqli_query($con, $s);
  $rows = mysqli_num_rows($sel);

  if ($rows == 1) {
    $data = mysqli_fetch_array($sel);
    $_SESSION['id'] = $data['id'];
     header("Location: home.php");
     exit();
  } else {
    echo "<script>alert('Invalid username and password');</script>";
    echo "<script>window.location='login.php'</script>";
  }
}
?>  
