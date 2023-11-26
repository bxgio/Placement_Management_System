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

$com_id = $_GET['idd'];
$company = mysqli_query($con, "SELECT * FROM newplacement WHERE id=$com_id");
$row = mysqli_fetch_array($company);
$count = mysqli_query($con, "SELECT * FROM pdf WHERE c_id=$com_id");
$resCount = mysqli_num_rows($count);
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

        }

        th,
        td {
            padding: 8px;
            border: 1px solid black;
            text-align: center;
        }

        th {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <h3>Date:</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <?php
                $com_id = $_GET['idd'];
                $company = mysqli_query($con, "SELECT * FROM newplacement WHERE id=$com_id");
                $row = mysqli_fetch_array($company);
                $count = mysqli_query($con, "SELECT * FROM pdf WHERE c_id=$com_id");
                $totalStudents = mysqli_num_rows($count);
                ?>
                <th colspan="7">Company Name: <?php echo $row['name']; ?></th>
            </tr>
            <tr>
                <th colspan="7">Total Students: <?php echo $totalStudents; ?></th>
            </tr>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>D no</th>
                <th>Department</th>
                <th>Phone Number</th>
                <th>E mail</th>
                <th> &nbsp; &nbsp; &nbsp;Signature &nbsp; &nbsp; &nbsp; </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            $com_id = $row['id'];
            $checkQuery = mysqli_query($con, "SELECT * FROM pdf WHERE c_id = $com_id");
            $i = 1;
            while ($row1 = mysqli_fetch_assoc($checkQuery)) {
                $rows = $row1['s_id'];
                $studentQuery = mysqli_query($con, "SELECT * FROM studentdetail WHERE id = $rows");
                while ($result = mysqli_fetch_assoc($studentQuery)) {
            ?>
                    <tr style="margin-bottom: 20%;">
                        <td style="text-align: center;"><?php echo $i; ?></td>
                        <td style="text-align: center;"><?php echo $result['name']; ?></td>
                        <td style="text-align: center;"><?php echo $result['dno']; ?></td>
                        <td style="text-align: center;"><?php echo $result['major']; ?></td>
                        <td style="text-align: center;"><?php echo $result['phone']; ?></td>
                        <td style="text-align: center;"><?php echo $result['email']; ?></td>
                        <td style="text-align: center;"></td>
                    </tr>
            <?php
                    $i++;
                }
            }
            if ($i === 1) {
                echo '<tr><td colspan="10">No student Applied.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>


</html>