<?php
include("./database/db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    // Check if connection was successful
    if (mysqli_connect_errno()) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    // Get the search query from the form
    $search_query = mysqli_real_escape_string($con, $_POST['job_search']);

    // Perform the search query in your database
    $result = mysqli_query($con, "SELECT * FROM newplacement WHERE title LIKE '%$search_query%' OR location LIKE '%$search_query%'");

    // Display the search results
    while ($row = mysqli_fetch_array($result)) {
        // Display each job result as needed
        echo "Job Title: " . $row['title'] . "<br>";
        echo "Location: " . $row['location'] . "<br>";
        echo "<hr>";
    }

    // Close the database connection
    mysqli_close($con);
}
