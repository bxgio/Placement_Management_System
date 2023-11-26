<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("./database/db.php");

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];

        $delete = mysqli_query($con, "DELETE FROM `newplacement` WHERE id = '$id'");
        $delete_com = mysqli_query($con, "DELETE FROM `pdf` WHERE c_id = '$id'");

        if ($delete && $delete_com) {
            echo "<script>alert('Successfully deleted');window.location='companydetails.php';</script>";
        } else {
            echo "<script>alert('Failed to delete')</script>";
        }
    }
    ?>


</body>

</html>