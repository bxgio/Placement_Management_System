<!DOCTYPE html>
<html>
<head>
    <title>My Stylish Web Page</title>
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
        </ul>
    </nav>
    
    <!-- Your webpage content goes here -->
    <div class="container mt-4">
        <h2>Welcome to the Student Information System</h2>
        <p>This system allows you to manage student details and marks. You can add, view, update, and delete student information.</p>
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
