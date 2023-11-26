<?php
include("./database/db.php");
$id = $_GET['id'];
echo $id;
$check = "SELECT * FROM newplacement where id=$id";
$reg = mysqli_query($con,$check);
$fetch = mysqli_fetch_array($reg);
echo $fetch['name'];
?>