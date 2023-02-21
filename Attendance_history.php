<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("Location: Login.php");
  exit;
}
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet" href="css/styles.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/filter.js"></script>
  <title>Attendance Hsitory - ACM Attendance Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<script type='text/javascript'>
  $(document).ready(function() {
    $('.filter').multifilter()
  })
</script>
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
          <button onclick="location.href='./Logout.php'" class="btn btn-danger d-flex ms-3">
            <span class="material-symbols-outlined"> logout </span>Logout
          </button>
        </span>
      </div>
    </div>
  </nav>
  <div class="container Members">
    <div class="row mt-5 mb-3">
      <div class="col-lg-12">
        <h1>Attendance History</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table class="table table-striped table-borderless table-hover">
            <thead>
              <tr>
                <th>
                  <label>Full Name</label>
                  <input class="filter" type="text" class="search-input" data-col="Full Name"/>
                </th>
                <th>
                  <label>Amrita ID</label>
                  <input class="filter" type="text" class="search-input" data-col="Amrita ID"/>
                </th>
                <th>
                  <label>SIG</label>
                  <input class="filter" type="text" class="search-input" data-col="SIG"/>
                </th>
                <th>
                  <label>Date</label>
                  <input class="filter" type="text" class="search-input" data-col="Date"/>
                </th>
                <th>
                  <label>In-Time</label>
                  <input class="filter" type="text" class="search-input" data-col="In-Time"/>
                </th>
                <th>
                  <label>Out-Time</label>
                  <input class="filter" type="text" class="search-input" data-col="Out-Time"/>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $queryattendanceHistory = "SELECT * FROM `attendance` ORDER BY `date` DESC";
              $exe = mysqli_query($conn, $queryattendanceHistory);
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
    <div class="row text-center text-white bottom-0">
      <div class="col-lg-12">
        <p>© 2023 ACM Amritapuri All Rights Reserved. Made in ❤️ with India.</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>