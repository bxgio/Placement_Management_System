<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Update Student Details</h1>
        <?php
        if (isset($_POST['update'])){
            // Process the form submission
            $studentId = $_GET['id'];
            $name = $_POST['name'];
            $dno = $_POST['dno'];
            $mark = $_POST['mark'];
            
            // Perform database update here
            $con = mysqli_connect("localhost", "root", "", "login");
            $updateQuery = "UPDATE student SET name = '$name', dno = '$dno', mark = '$mark' WHERE id = $studentId";
            if (mysqli_query($con, $updateQuery)) {
                echo "<div class='alert alert-success'>Student details updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating student details.</div>";
            }
            mysqli_close($con);
        } else {
            // Retrieve the current student details from the database
            $studentId = $_GET['id']; // Assuming you passed the ID as a query parameter
            $con = mysqli_connect("localhost", "root", "", "login");
            $query = "SELECT * FROM student WHERE id = $studentId";
            $result = mysqli_query($con, $query);
            
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Display the update form
                echo "<form method='post' action='update.php'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<div class='form-group'>
                        <label for='name'>Name:</label>
                        <input type='text' class='form-control' id='name' name='name' value='" . $row['name'] . "'>
                      </div>";
                echo "<div class='form-group'>
                        <label for='dno'>Roll Number:</label>
                        <input type='text' class='form-control' id='dno' name='dno' value='" . $row['dno'] . "'>
                      </div>";
                echo "<div class='form-group'>
                        <label for='mark'>Marks:</label>
                        <input type='text' class='form-control' id='mark' name='mark' value='" . $row['mark'] . "'>
                      </div>";
                echo "<button type='submit'id='update' name='update' class='btn btn-primary'>Update</button>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-danger'>Student not found.</div>";
            }
            mysqli_close($con);
        }
        ?>
    </div>

    <!-- Add Bootstrap JavaScript and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
