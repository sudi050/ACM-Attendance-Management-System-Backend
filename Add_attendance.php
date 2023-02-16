<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("Location: Login.php");
  exit;
}
$usernotfound = false;
date_default_timezone_set("Asia/Calcutta");
include("connection.php");
if (isset($_POST["submit"])) {
  $amritaID = $_POST["amritaID"];
  $querymemberSearch = "SELECT * FROM `members` WHERE amritaID='$amritaID'";
  $exe = mysqli_query($conn, $querymemberSearch);
  $memberDetails = mysqli_fetch_assoc($exe);
  if ($memberDetails === null) {
    $usernotfound = true;
  } else {
    $fullName = $memberDetails["fullName"];
    $sig = $memberDetails["sig"];
    $date = date("d/m/Y");
    $time = date("h:i:s A");
    $memberexistfortheDay = "SELECT * FROM `attendance` WHERE amritaID='$amritaID' AND date='$date'";
    $exe = mysqli_query($conn, $memberexistfortheDay);
    $attendanceDetails = mysqli_fetch_assoc($exe);
    if ($attendanceDetails === null) {
      $queryaddAttendance = "INSERT INTO `attendance`(`amritaID`, `date`, `timeIN`, `timeOut`)VALUES('$amritaID', '$date', '$time', '')";
      $exe = mysqli_query($conn, $queryaddAttendance);
    } else {
      $queryupdateAttendance = "UPDATE `attendance` SET `timeOut` = '$time' WHERE amritaID='$amritaID'";
      $exe = mysqli_query($conn, $queryupdateAttendance);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="css/styles.css" />
  <script src="js/filter.js"></script>
  <title>Add Attendance - ACM Attendance Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="js/export.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
      <a class="navbar-brand" href="./Dashboard.php">
        <img src="Images/website_logo.webp" alt="Bootstrap" width="150px" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="material-symbols-outlined" style="color: #fafafa;">
          menu
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./Add_members.php">Add Members</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./All_members.php">All Members</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./Attendance_history.php">Attendance History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./Credits.php">Credits</a>
          </li>
        </ul>
        <span class="navbar-text d-flex">
          <a href="./Add_attendance.php"><button class="btn btn-success">Add Attendance</button></a>
          <button class="btn btn-danger d-flex ms-3">
            <span onclick="location.href='./Logout.php'" class="material-symbols-outlined"> logout </span>Logout
          </button>
        </span>
      </div>
    </div>
  </nav>
  <?php
  if ($usernotfound) {
    echo '
      <div class="alert alert-danger" role="alert">
        Member not found!
      </div>
      ';
  }
  ?>
  <div class="container Members">
    <div class="row mt-5">
      <div class="col-lg-12">
        <h1>Keep your learning streaks high!</h1>
      </div>
    </div>
    <div class="row addAttendance mt-4">
      <div class="col-lg-12">
        <form method="post">
          <div class="d-flex justify-content-between">
            <div>
              <input name="amritaID" placeholder="Amrita ID">
              <button name="submit" class="btn btn-success">Mark Attendance</button>
            </div>
            <div>
              <button onclick="exportTableToExcel('tblData', 'attendance-data')" class="btn btn-success">Export</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table id="tblData" class="table table-striped table-borderless table-hover">
            <thead>
              <tr>
                <th>
                  <input type="text" class="search-input" placeholder="Full Name" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="Amrita ID" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="SIG" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="Gender" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="Date" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="In-time" />
                </th>
                <th>
                  <input type="text" class="search-input" placeholder="Out-time" />
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $date = date("d/m/Y");
              $queryattendanceoftheDay = "SELECT * FROM `attendance` WHERE date='$date'";
              $exe = mysqli_query($conn, $queryattendanceoftheDay);
              $num = mysqli_num_rows($exe);
              if ($num != 0) {
                while ($allAttendance = mysqli_fetch_assoc($exe)) {
                  $querymemberSearch = "SELECT * FROM `members` WHERE `amritaID`='$allAttendance[amritaID]'";
                  $exe2 = mysqli_query($conn, $querymemberSearch);
                  $memberDetails = mysqli_fetch_assoc($exe2);
                  echo "
                      <tr>
                      <td>" . $memberDetails['fullName'] . "</td>
                      <td>" . $allAttendance['amritaID'] . "</td>
                      <td>" . $memberDetails['sig'] . "</td>
                      <td>" . $memberDetails['gender'] . "</td>
                      <td>" . $allAttendance['date'] . "</td>
                      <td>" . $allAttendance['timeIN'] . "</td>
                      <td>" . $allAttendance['timeOut'] . "</td>
                    </tr>
                      ";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row text-center text-white">
      <div class="col-lg-12">
        <p>© 2023 ACM Amritapuri All Rights Reserved. Made in ❤️ with India.</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>