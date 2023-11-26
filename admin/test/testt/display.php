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
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Marks</th>
                </tr>
            </thead>

            <?php
            // Establish a database connection
            $con = mysqli_connect("localhost", "root", "", "login");

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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No student records found.</td></tr>";
            }

            // Close the database connection
            mysqli_close($con);
            ?>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
