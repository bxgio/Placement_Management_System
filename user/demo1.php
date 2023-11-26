<?php

session_start();
include('./database/db.php');
include('./alert.php');
$id = 20;
$select = "SELECT * FROM newplacement WHERE id='$id'";
$reg = mysqli_query($con, $select);
$fetch = mysqli_fetch_array($reg);
echo $fetch['name'];


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $filename = $_FILES["resume"]["name"];
//     $filedata = $_FILES["resume"]["tmp_name"];

//     $sql = "INSERT INTO pdf (resume) VALUES (?)";
//     $stmt = $con->prepare($sql);
//     $stmt->bind_param("s", $filename, $filedata);

//     if ($stmt->execute()) {
//         echo "PDF file uploaded and inserted successfully.";
//     } else {
//         echo "Error uploading PDF: " . $stmt->error;
//     }

//     $stmt->close();
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fileTmpPath = $_FILES['resume']['tmp_name'];
    $fileName = $_FILES['resume']['name'];
    $fileSize = $_FILES['resume']['size'];
    $fileType = $_FILES['resume']['type'];
    if ($fileSize / 1024 <= 500) {
        $uploadDir = 'resume_uploads/'; // Directory to save uploaded photos
        $uploadPath = $uploadDir . $fileName;
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($fileTmpPath, $uploadPath)) {
            // Update the profile photo path in the database
            $updatePhotoQuery = "INSERT INTO pdf (resume) VALUES ('$uploadPath')";
            mysqli_query($con, $updatePhotoQuery);
            echo "File upload";
        }
    } else {
        echo "file size must be less than 500";
    }
}
