<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Add Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="display.php">Select All Student</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php">Delete Some Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update.php">Update Students</a>
                </li>
            </ul>
        </nav>
        <h1 class="mt-5">Student Details</h1>
        <form method="post">
            <table class="table table-bordered mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Roll Number</th>
                        <th>Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                // Establish a database connection
                $con = mysqli_connect("localhost", "root", "", "login");

                if (isset($_POST['delete'])) {
                    $deleteId = $_POST['delete'];
                    
                    // Fetch the student's name before deletion
                    $nameQuery = "SELECT name FROM student WHERE id = $deleteId";
                    $nameResult = mysqli_query($con, $nameQuery);
                    
                    if ($nameResult && $nameRow = mysqli_fetch_assoc($nameResult)) {
                        $studentName = $nameRow['name'];
                        
                        // Delete the student record
                        $deleteQuery = "DELETE FROM student WHERE id = $deleteId";
                        
                        if (mysqli_query($con, $deleteQuery)) {
                            echo "<div class='alert alert-success'>$studentName's record deleted successfully.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error deleting the record.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Error fetching student data.</div>";
                    }
                }
                

                // Fetch student details from the database
                $query = "SELECT * FROM student";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['dno'] . "</td>";
                        echo "<td>" . $row['mark'] . "</td>";
                        echo "<td><button type='submit' name='delete' class='btn btn-danger' value='" . $row['id'] . "'>Delete</button></td>";
                                    echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No student records found.</td></tr>";
                }

                // Close the database connection
                mysqli_close($con);
                ?>
            </table>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
