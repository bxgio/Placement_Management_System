<?php
session_start();
include("./database/db.php");
if (!isset($_SESSION['id'])) {
    header('location: login.php');
}
if (isset($_GET['log']) && $_GET['log'] === 'yes') {
    unset($_SESSION["id"]);
    header("location:login.php");
} elseif (isset($_GET['log']) && $_GET['log'] === 'no') {
}

$id = $_SESSION['id'];
$select = "SELECT * FROM users WHERE id='$id'";
$reg = mysqli_query($con, $select);
$fetch = mysqli_fetch_array($reg);

$idd = $fetch['id'];
// Fetch user's data from the studentdetail table
$selectUserQuery = "SELECT * FROM studentdetail WHERE id='$idd'";
$userResult = mysqli_query($con, $selectUserQuery);
$userData = mysqli_fetch_assoc($userResult);
$row = mysqli_num_rows($userResult);

if (isset($_POST['submit'])) {
    $name = $fetch['name'];
    $dno = $fetch['dno'];
    $major = $_POST['major'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    $skill = $_POST['skill'];
    $sslc = $_POST['10th'];
    $hsc = $_POST['12th'];
    $one = $_POST['1st'];



    // Check if the user's data already exists
    $checkQuery = "SELECT * FROM studentdetail WHERE id='$idd'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // User data exists, perform an UPDATE operation
        $updateQuery = "UPDATE studentdetail SET major='$major', phone='$phone', email='$email', degree='$degree', year='$year', skill='$skill', 10th='$sslc', 12th='$hsc', 1st='$one' WHERE id='$idd'";

        if (mysqli_query($con, $updateQuery)) {
            echo "<script>alert('Profile updated successfully'); window.location='./user_home.php';</script>";
        } else {
            echo "<script>alert('Update failed'); window.location='./profile.php';</script>";
        }
    } else {
        // User data doesn't exist, perform an INSERT operation
        $insertQuery = "INSERT INTO studentdetail(id, name, dno, major, phone, email, degree, year, skill, 10th, 12th, 1st, profile_photo) VALUES ('$idd','$name','$dno','$major','$phone','$email','$degree','$year','$skill','$sslc','$hsc','$one','$uploadPath')";

        if (mysqli_query($con, $insertQuery)) {
            echo "<script>alert('Profile added successfully'); window.location='./user_home.php';</script>";
        } else {
            echo "<script>alert('Addition failed'); window.location='./profile.php';</script>";
        }
    }

    $student_photo = $fetch['dno'];

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_photo']['tmp_name'];
        $fileName = $_FILES['profile_photo']['name'];
        $fileSize = $_FILES['profile_photo']['size'];
        $fileType = $_FILES['profile_photo']['type'];

        $allowedExtensions = ['jpg', 'png', 'jpeg'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = $student_photo . '_profile.' . $fileExtension;

            $uploadDir = 'profile_photo/'; // Directory to save uploaded photos
            $uploadPath = $uploadDir . $newFileName;

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // Update the profile photo path in the database
                $updatePhotoQuery = "UPDATE studentdetail SET profile_photo='$uploadPath' WHERE id='$idd'";
                mysqli_query($con, $updatePhotoQuery);
            }
        } else {
            echo "Invalid file format. Please upload a JPG, PNG, or JPEG.";
        }
    }
}
?>



<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <title>My Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="../assets/js/init-alpine.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="../assets/js/charts-lines.js" defer></script>
    <script src="../assets/js/charts-pie.js" defer></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <div class="py-2 text-gray-500 dark:text-gray-400 flex items-center">
                    <a href="https://sjctni.edu/" class="mr-2">
                        <img src="../admin/img/sjc.png" alt="College Logo" width="75" height="75" class="rounded-full" style="text-align: center;">
                    </a>
                    <span class="ml-3 text-lg font-bold text-gray-800 dark:text-gray-200">SJC Placement Management</span>
                </div>

                <ul class="mt-6">
                    <li class="relative px-6 py-3">

                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="user_home.php">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="relative px-10 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="profile.php">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="ml-4">Update Profile</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="placement.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                            </svg>

                            <span class="ml-4">Company List</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="applied.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                            </svg>

                            <span class="ml-4">Company Applied List</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="?log=yes" onclick="return confirm('Do you want to logout?')">
                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="ml-4">Logout</span>
                        </a>
                    </li>
                </ul>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
    <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden" x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu" @keydown.escape="closeSideMenu">
      <div class="py-4 text-gray-500 dark:text-gray-400">
        <div class="py-2 text-gray-500 dark:text-gray-400 flex items-center">
          <a href="https://sjctni.edu/" class="mr-2">
            <img src="../admin/img/sjc.png" alt="College Logo" width="75" height="75" class="rounded-full" style="text-align: center;">
          </a>
          <span class="ml-3 text-lg font-bold text-gray-800 dark:text-gray-200">SJC Placement Management</span>
        </div>

        <ul class="mt-6">
          <li class="relative px-10 py-3">
            <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
            <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="user_home.php">
              <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
              </svg>
              <span class="ml-4">Dashboard</span>
            </a>
          </li>
        </ul>
        <ul>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="placement.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
              </svg>

              <span class="ml-4">Company List </span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="applied.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
              </svg>

              <span class="ml-4">Company Applied List</span>
            </a>
          </li>
          <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="?log=yes" onclick="return confirm('Do you want to logout?')""
              >
              <svg
                          class=" w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
              </path>
              </svg>
              <span class="ml-4">Logout</span>
            </a>
          </li>
        </ul>
    </aside>


        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple" @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                            <div class="absolute inset-y-0 flex items-center pl-2">

                            </div>
                        </div>
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <ul class="flex items-center flex-shrink-0 space-x-6">
                            <li class='relative'>
                                <button class='align-middle rounded-full focus:shadow-outline-purple focus:outline-none' @click='toggleProfileMenu' @keydown.escape='closeProfileMenu' aria-label='Account' aria-haspopup='true'>
                                    <img class="object-cover w-8 h-8 rounded-full" src="<?php echo isset($userData['profile_photo']) ? $userData['profile_photo'] : '../image/user.png'; ?>" alt="" aria-hidden="true" />
                                </button>
                                <span class="text-gray-800"><?php echo $fetch['dno']; ?></span>
                                <template x-if='isProfileMenuOpen'>
                                    <ul x-transition:leave='transition ease-in duration-150' x-transition:leave-start='opacity-100' x-transition:leave-end='opacity-0' @click.away='closeProfileMenu' @keydown.escape='closeProfileMenu' class='absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700' aria-label='submenu'>
                                        <li class='flex'>
                                            <a class='inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200' href='profile.php'>
                                                <svg class='w-4 h-4 mr-3' aria-hidden='true' fill='none' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' viewBox='0 0 24 24' stroke='currentColor'>
                                                    <path d='M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'>
                                                    </path>
                                                </svg>
                                                <span>Profile</span>
                                            </a>
                                        </li>
                                        <li class="flex">
                                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="?log=yes" onclick="return confirm('Do you want to logout?')">
                                                <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                    </path>
                                                </svg>
                                                <span>Log out</span>
                                            </a>
                                        </li>
                                    </ul>
                                </template>
                            </li>
                        </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200 text-center">
                        Personal and Academic Information
                    </h2>

                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" class="form-control" name="name" value="<?php echo $fetch['name']; ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>D no</td>
                                <td>
                                    <input type="text" class="form-control" name="dno" value="<?php echo $fetch['dno']; ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Major Subject</td>
                                <td>
                                    <input type="text" class="form-control" name="major" value="<?php echo isset($userData['major']) ? $userData['major'] : ''; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>
                                    <input type="number" class="form-control" name="phone" placeholder="Enter your Phone number" value="<?php echo isset($userData['phone']) ? $userData['phone'] : ''; ?>" maxlength="10" required>
                                </td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td>
                                    <input type="email" class="form-control" name="email" placeholder="Enter your Email number" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Degree</td>
                                <td>
                                    <select class="form-select form-select-sm" aria-label="large select example" name="degree" required>
                                        <option value="">Select Degree</option>
                                        <option value="UG" <?php echo isset($userData['degree']) && $userData['degree'] === 'UG' ? 'selected' : ''; ?>>UG</option>
                                        <option value="PG" <?php echo isset($userData['degree']) && $userData['degree'] === 'PG' ? 'selected' : ''; ?>>PG</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Year</td>
                                <td>
                                    <select class="form-select form-select-sm" aria-label="small select example" name="year" required>
                                        <option value="">Select Year</option>
                                        <option value="1st year" <?php echo isset($userData['year']) && $userData['year'] === '1st year' ? 'selected' : ''; ?>>1st</option>
                                        <option value="2nd year" <?php echo isset($userData['year']) && $userData['year'] === '2nd year' ? 'selected' : ''; ?>>2nd</option>
                                        <option value="3rd year" <?php echo isset($userData['year']) && $userData['year'] === '3rd year' ? 'selected' : ''; ?>>3rd</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Skills</td>
                                <td>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="skill" rows="3" placeholder="Enter your Skills" required><?php echo isset($userData['skill']) ? $userData['skill'] : ''; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>10th</td>
                                <td>
                                    <input type="number" class="form-control" name="10th" placeholder="Enter your 10th percentage" value="<?php echo isset($userData['10th']) ? $userData['10th'] : ''; ?>" max="100" required>
                                </td>
                            </tr>

                            <tr>
                                <td>12th</td>
                                <td>
                                    <input type="number" class="form-control" name="12th" placeholder="Enter your 12th percentage" value="<?php echo isset($userData['12th']) ? $userData['12th'] : ''; ?>" max="100" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Current Percentage</td>
                                <td>
                                    <input type="number" class="form-control" name="1st" placeholder="Enter your current semester percentage" value="<?php echo isset($userData['1st']) ? $userData['1st'] : ''; ?>" max="100">
                                </td>
                            </tr>



                            <tr>
                                <td>Update Profile photo</td>
                                <td>
                                    <input type='file' name='profile_photo' id='profile' accept=".jpg, .jpeg, .png" required>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </main>

        </div>
    </div>
</body>

</html>