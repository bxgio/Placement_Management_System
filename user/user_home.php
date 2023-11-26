<?php
include("database/db.php");
session_start();
if (!isset($_SESSION['id'])) {
  header('location:login.php');
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


$idd = $_SESSION['id'];
// Fetch user's data from the studentdetail table
$selectUserQuery = "SELECT * FROM studentdetail WHERE id='$idd'";
$userResult = mysqli_query($con, $selectUserQuery);
$userData = mysqli_fetch_assoc($userResult);

?>



<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
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
    .custom-card-title {
      background-color: #C0E8F9;
      padding: 8px;
      border-radius: 0.25rem;
    }
  </style>
</head>

<body>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
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
            <li class='relative'>
              <button class='align-middle rounded-full focus:shadow-outline-purple focus:outline-none' @click='toggleProfileMenu' @keydown.escape='closeProfileMenu' aria-label='Account' aria-haspopup='true'>
                <img class="object-cover w-8 h-8 rounded-full" src="<?php echo isset($userData['profile_photo']) ? $userData['profile_photo'] : '../image/user.png'; ?>" alt="" aria-hidden="true" />
              </button>
              <template x-if='isProfileMenuOpen'>
                <ul x-transition:leave='transition ease-in duration-150' x-transition:leave-start='opacity-100' x-transition:leave-end='opacity-0' @click.away='closeProfileMenu' @keydown.escape='closeProfileMenu' class='absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700' aria-label='submenu'>
                  <li class='flex'>
                    <a class='inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200' href='user_home.php'>
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
      <?php
      $idd = $_SESSION['id'];
      $selectUserQuery = "SELECT * FROM studentdetail WHERE id='$idd'";
      $userResult = mysqli_query($con, $selectUserQuery);
      if (mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult);
      ?>
        <main class="h-full overflow-y-auto">
          <div class="container custom-container px-9 mx-auto my-4">
            <div class="row">
              <!-- Left Column -->
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h2 class="card-title text-primary mb-4 text-center font-semibold">Personal Information</h2>
                    <div class="table-responsive">
                      <table class="table table-bordered table-lg mx-auto">
                        <tr>
                          <th>Profile Picture</th>
                          <td><?php
                              $profile_photo = $userData['profile_photo'];
                              echo "<img src='../user/$profile_photo' alt='Profile Photo' class='rounded' style='max-width: 100px; border: 2px solid #ccc;' />"; // Added 'rounded' class for rounded borders
                              ?></td>
                        </tr>
                        <tr>
                          <th>Name</th>
                          <td><?php echo $userData['name']; ?></td>
                        </tr>
                        <tr>
                          <th>D No</th>
                          <td><?php echo $userData['dno']; ?></td>
                        </tr>
                        <tr>
                          <th>Major</th>
                          <td><?php echo $userData['major']; ?></td>
                        </tr>
                        <tr>
                          <th>Degree</th>
                          <td><?php echo $userData['degree']; ?></td>
                        </tr>
                        <tr>
                          <th>Year</th>
                          <td><?php echo $userData['year']; ?></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><?php echo $userData['email']; ?></td>
                        </tr>
                        <tr>
                          <th>Mobile Number</th>
                          <td><?php echo $userData['phone']; ?></td>
                        </tr>
                        <tr>
                          <th>Skills</th>
                          <td><?php echo $userData['skill']; ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <h2 class="card-title text-primary mb-4 text-center font-semibold">Academics Information</h2>
                      <table class="table table-bordered table-lg mx-auto">
                        <tr>
                          <th>Studies</th>
                          <th>Percentage</th>
                        </tr>
                        <tr>
                          <td>SSLC Percentage</td>
                          <td><?php echo $userData['10th']; ?></td>
                        </tr>
                        <tr>
                          <td>HSC Percentage</td>
                          <td><?php echo $userData['12th']; ?></td>
                        </tr>
                        <tr>
                          <td>Current Semester Percentage</td>
                          <td><?php echo $userData['1st']; ?></td>
                        </tr>

                        </tr>
                        <tr>
                          <td><a href="profile.php" class="btn btn-primary">Edit </a></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
        } else {
          ?>
            <br><br><br>
            <div class="card bg-light shadow">
              <div class="card-body">
                <h2 class="card-title custom-card-title">Personal Information</h2>
                <ul class="list-unstyled">
                  <li class="d-flex align-item-center"><strong>Name:</strong> <?php echo $fetch['name']; ?></li>
                  <li class="d-flex align-item-center"><strong>D No:</strong> <?php echo $fetch['dno']; ?></li>
                </ul>
              </div>
            </div>
            <div class="card bg-light shadow mt-4">
              <div class="card-body">
                <h2 class="card-title custom-card-title">Academic Marks</h2>
                <ul class="list-unstyled academic-marks-list">

                </ul>
              </div>
              <div class="text-center mt-2 py-1">
                No data found!
              </div>
              <a href="profile.php" class="btn btn-primary">Add Details</a>
            </div>
          <?php
        }
          ?>


          </div>
        </main>

    </div>
  </div>
</body>

</html>