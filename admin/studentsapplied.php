<?php
session_start();
include("./database/db.php");
error_reporting(0);
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}


if (isset($_GET['log']) && $_GET['log'] === 'yes') {
    unset($_SESSION["id"]);
    header("location:login.php");
} elseif (isset($_GET['log']) && $_GET['log'] === 'no') {
}
$com_id = $_GET['idd'];
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
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <div class="py-2 text-gray-500 dark:text-gray-400 flex items-center">
                    <a href="https://sjctni.edu/" class="mr-2">
                        <img src="img/sjc.png" alt="College Logo" width="75" height="75" class="rounded-full" style="text-align: center;">
                    </a>
                    <span class="ml-3 text-lg font-bold text-gray-800 dark:text-gray-200">SJC Placement Management</span>
                </div>

                <br><br>
                <ul>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="home.php">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative px-10 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100" href="companydetails.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                            </svg>

                            <span class="ml-4">Students Applied</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="?log=yes" onclick="return confirm('Do you want to logout?')">
                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
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
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none" @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full" src="../image/user.png" alt="" aria-hidden="true" />
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu" class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" href="profile.php">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200" hhref="?log=yes" onclick="return confirm('Do you want to logout?')">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
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
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="align-items: center">
                        <?php
                        $com_id = $_GET['idd'];
                        $company = mysqli_query($con, "SELECT * FROM newplacement WHERE id=$com_id");
                        $row = mysqli_fetch_array($company);
                        $count_query = mysqli_query($con, "SELECT count(*) as count FROM pdf WHERE c_id=$com_id");
                        $count = mysqli_fetch_array($count_query);
                        $student_count = $count['count'];
                        ?>
                        <table class="table table-bordered table-lg mx-auto">
                            <tbody>
                                <tr>
                                    <th>Company Name </th>
                                    <td><?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Students Applied</th>
                                    <td><?php echo $student_count; ?></td>

                                </tr>
                            </tbody>
                        </table>


                    </h2>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="appliedstudentpdf.php?idd=<?php echo $row['id']; ?>"><button type="button" class="btn btn-primary">Print</button></a>
                        <a href="attendancepdf.php?idd=<?php echo $row['id']; ?>"><button type="button" class="btn btn-outline-primary">Attendance Sheet</button></a>
                    </div>
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="table-light">
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3" style="text-align: center;">Select</th>
                                            <th class="px-4 py-3" style="text-align: center;">S.No</th>
                                            <th class="px-4 py-3" style="text-align: center;">Name</th>
                                            <th class="px-4 py-3" style="text-align: center;">D no</th>
                                            <th class="px-4 py-3" style="text-align: center;">Department</th>
                                            <th class="px-4 py-3" style="text-align: center;">Contact No</th>
                                            <th class="px-4 py-3" style="text-align: center;">Skills</th>
                                            <th class="px-4 py-3" style="text-align: center;">10th</th>
                                            <th class="px-4 py-3" style="text-align: center;">12th</th>
                                            <th class="px-2 py-3">Resume</th>
                                            <th class="px-2 py-3">Profile View</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        $com_id = $row['id'];
                                        $checkQuery = mysqli_query($con, "SELECT * FROM pdf WHERE c_id = $com_id");
                                        $i = 1;
                                        while ($row1 = mysqli_fetch_assoc($checkQuery)) {
                                            $rows = $row1['s_id'];
                                            $resume = $row1['resume'];
                                            $studentQuery = mysqli_query($con, "SELECT * FROM studentdetail WHERE id = $rows ORDER BY dno"); // Updated query with ORDER BY
                                            while ($result = mysqli_fetch_assoc($studentQuery)) {
                                        ?>
                                                <tr style="margin-bottom: 20%;">
                                                    <td style="text-align: center;"><input type="checkbox" name="student_ids[]" value="<?php echo $result['id']; ?>"></td>
                                                    <td style="text-align: center;"><?php echo $i; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['name']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['dno']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['major']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['phone']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['skill']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['10th']; ?></td>
                                                    <td style="text-align: center;"><?php echo $result['12th']; ?></td>
                                                    <td style="text-align: center;">
                                                        <a href="../user/<?php echo $resume; ?>" target="_blank">
                                                            <button type="button" class="btn btn-primary">View</button>
                                                        </a>
                                                    </td>
                                                    <td style="text-align: center;"><a href="studentview.php?id=<?php echo $result['id']; ?>">
                                                            <button type="button" class="btn btn-success">Review</button>
                                                        </a>
                                                    </td>
                                                </tr>

                                        <?php
                                                $i++;
                                            }
                                        }


                                        if ($i === 1) {
                                            echo '<tr><td colspan="11">No student Applied.</td></tr>';
                                        }
                                        ?>
                                    </tbody>

                                </table>
                                <a href="studentview.php?id=<?php echo $result['id']; ?>">
                                    <button type="button" id="select" name="select" class="btn btn-info">Submit</button>
                                </a>


                            </div>

                        </div>