<?php
session_start();

if (isset($_GET['log']) && $_GET['log'] === 'yes') {
    unset($_SESSION["id"]);
    header("location:login.php");
} elseif (isset($_GET['log']) && $_GET['log'] === 'no') {
    
}

?>
<!-- Add a link or button to initiate the logout process -->
<a href="?log=yes" onclick="return confirm('Do you want to logout?')">Logout</a>
