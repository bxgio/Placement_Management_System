<?php
session_start();
$con=mysqli_connect("localhost","root","","login");

if (isset($_POST['submit'])) {
  $a = $_POST['name'];
  $b = $_POST['dno'];
  $c = $_POST['mark'];

  $s = "insert into student(name,dno,mark) values('$a','$b','$c')";

  
  if (mysqli_query($con, $s)) {
    
     echo "<script>alert('Inserted');</script>";
     
  } else {
    echo "<script>alert('Not Inserted');</script>";
  }
}
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Add Student Details</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }

        header {
            background-color: #343a40; /* Dark gray background for the header */
            color: #ffffff; /* White text color */
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: #343a40;
            font-weight: bold;
        }

        nav a:hover {
            color: #007bff; /* Blue color on hover */
        }

        footer {
            background-color: #343a40; /* Dark gray background for the footer */
            color: #ffffff; /* White text color */
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Website</h1>
        <p>Your tagline or description here.</p>
    </header>
    
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="add.php">Add Student</a></li>
            <li><a href="display.php">Select All Student</a></li>
            <li><a href="delete.php">Delete Some Students</a></li>
            <li><a href="update.php">Update Students</a></li>
            <li><a href="login.php">Log Out</a></li>
        </ul>
    </nav>
    
    <!-- Your webpage content goes here -->
    <div class="container mt-4">
        <h2>Add Student Details</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="studentName">Student Name</label>
                <input type="text" class="form-control" name="name" id="studentName" placeholder="Enter student name">
            </div>
            <div class="form-group">
                <label for="studentRoll">Student Roll Number</label>
                <input type="text" class="form-control" name="dno" id="studentRoll" placeholder="Enter roll number">
            </div>
            <div class="form-group">
                <label for="studentMarks">Student Marks</label>
                <input type="number" class="form-control" name="mark" id="studentMarks" placeholder="Enter marks">
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <footer>
        &copy; 2023 My Stylish Website. All rights reserved.
    </footer>

    <!-- Add Bootstrap JavaScript and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
