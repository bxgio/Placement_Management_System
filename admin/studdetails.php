<?php
session_start();
include("./database/db.php");
if (!isset($_SESSION['id'])) {
  header('location:login.php');
}
$select = mysqli_query($con, "SELECT * FROM newplacement");
if (isset($_GET['log']) && $_GET['log'] === 'yes') {
  unset($_SESSION["id"]);
  header("location:login.php");
} elseif (isset($_GET['log']) && $_GET['log'] === 'no') {
}
$idd = $_SESSION['id'];
// Fetch user's data from the studentdetail table
$selectUserQuery = "SELECT * FROM studentdetail WHERE id='$idd'";
$userResult = mysqli_query($con, $selectUserQuery);
$userData = mysqli_fetch_assoc($userResult);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="../assets/js/init-alpine.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="../assets/js/charts-lines.js" defer></script>
  <script src="../assets/js/charts-pie.js" defer></script>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #ccc;
      margin: 0 auto;
      /* Center the table horizontally */
    }

    th,
    td {
      padding: 8px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #fff;
    }
  </style>
</head>

<body>
  <table>
    <thead>
      <tr>
        <th colspan="9" style="text-align: center;">STUDENT DETAILS</th>
      </tr>
      <tr>
        <th style="text-align: center;">S.No</th>
        <th style="text-align: center;">Name</th>
        <th style="text-align: center;">D no</th>
        <th style="text-align: center;">Department</th>
        <th style="text-align: center;">Phone number</th>
        <th style="text-align: center;">Email</th>
        <th style="text-align: center;">Skills</th>
        <th style="text-align: center;">10th</th>
        <th style="text-align: center;">12th</th>
        <th style="text-align: center;">Current Semester%</th>
        
      </tr>
    </thead>

    <tbody>
      <?php
      $course = mysqli_query($con, "SELECT * FROM studentdetail");
      $i = 1;
      while ($row = mysqli_fetch_array($course)) {
      ?>
        <tr style="margin-bottom: 20%;">
          <td style="text-align: center;"><?php echo $i; ?></td>
          <td style="text-align: center;"><?php echo $row['name']; ?></td>
          <td style="text-align: center;"><?php echo $row['dno']; ?></td>
          <td style="text-align: center;"><?php echo $row['major']; ?></td>
          <td style="text-align: center;"><?php echo $row['phone']; ?></td>
          <td style="text-align: center;"><?php echo $row['email']; ?></td>
          <td style="text-align: center;"><?php echo $row['skill']; ?></td>
          <td style="text-align: center;"><?php echo $row['10th']; ?></td>
          <td style="text-align: center;"><?php echo $row['12th']; ?></td>
          <td style="text-align: center;"><?php echo $row['1st']; ?></td>
        </tr>
      <?php
        $i++;
      }

      ?>
    </tbody>
  </table>

</body>

</html>