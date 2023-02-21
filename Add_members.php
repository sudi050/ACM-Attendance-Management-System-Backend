<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("Location: Login.php");
  exit;
}
include("connection.php");
$showAlert = false;
$alreadyExist = false;
if (isset($_POST["submit"])) {
  $fullName = $_POST["fullName"];
  $emailID = $_POST["emailID"];
  $contactNumber = $_POST["contactNumber"];
  $amritaID = $_POST["amritaID"];
  $branch = $_POST["branch"];
  $sig = $_POST["sig"];
  $gender = $_POST["gender"];
  $residence = $_POST["residence"];
  $queryemailExist = "SELECT * FROM `members` WHERE emailID='$emailID'";
  $exe = mysqli_query($conn, $queryemailExist);
  if (mysqli_num_rows($exe) > 0) {
    $alreadyExist = true;
  } else {
    $queryaddMember = "INSERT INTO `members`(`fullName`, `amritaID`, `contactNumber`, `emailID`, `branch`, `sig`, `gender`, `residence`)VALUES('$fullName', '$amritaID', '$contactNumber', '$emailID', '$branch', '$sig', '$gender', '$residence')";
    $exe = mysqli_query($conn, $queryaddMember);
    if ($exe) {
      $showAlert = true;
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
  <title>Add Members - ACM Attendance Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
          <button onclick="location.href='./Logout.php'" class="btn btn-danger d-flex ms-3">
            <span class="material-symbols-outlined"> logout </span>Logout
          </button>
        </span>
      </div>
    </div>
  </nav>
  <?php
  if ($showAlert) {
    echo '
    <div class="alert alert-success" role="alert">
      Member added sucessfully!
    </div>
    ';
  }
  if ($alreadyExist) {
    echo '
    <div class="alert alert-danger" role="alert">
      A Member with same email already exists!
    </div>
    ';
  }
  ?>
  <div class="container addMembers">
    <div class="row mt-5">
      <div class="col-lg-12">
        <h1>Your success starts here!</h1>
      </div>
    </div>
    <div class="row mb-5">
      <div class="col-lg-12">
        <form class="row" method="post">
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined">person</span> Full
              Name</label>
            <input required type="text" class="form-control" id="Inputname" name="fullName" />
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> person_search </span>
              Amrita ID</label>
            <input required type="text" class="form-control" id="Inputid" name="amritaID" />
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> call </span> Contact Number</label>
            <input required type="text" class="form-control" id="Inputname" name="contactNumber" />
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> mail </span>
              Email</label>
            <input required type="email" class="form-control" id="Inputemail" name="emailID" />
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> account_tree </span>
              Select your branch</label>
            <select required class="form-select" aria-label="Default" name="branch">
              <option value="EAC">EAC</option>
              <option value="CSE">CSE</option>
              <option value="AIE">AIE</option>
              <option value="ECE">ECE</option>
              <option value="EEE">EEE</option>
              <option value="ME">ME</option>
              <option value="ELC">ELC</option>
              <option value="BCA">BCA</option>
              <option value="BCA-DS">BCA-DS</option>
              <option value="PHY">PHY</option>
            </select>
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined">
                auto_awesome_motion
              </span>
              Select your sig</label>
            <select required class="form-select" aria-label="Default" name="sig">
              <option value="AI">AI</option>
              <option value="CP">CP</option>
              <option value="Cyber Sec">CyberSec</option>
              <option value="Glitch">Glitch</option>
              <option value="Web Dev">Web Dev</option>
            </select>
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> group </span> Select
              your gender</label>
            <select required class="form-select" aria-label="Default" name="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-6">
            <label class="form-label d-flex"><span class="material-symbols-outlined"> home </span> Select
              your residence</label>
            <select required class="form-select" aria-label="Default" name="residence">
              <option value="Day Scholar">Day Scholar</option>
              <option value="Hostler">Hostler</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary d-flex justify-content-center" name="submit">
            <span class="material-symbols-outlined me-2"> add_circle </span>
            Add Member
          </button>
        </form>
      </div>
    </div>
    <div class="row text-center text-white">
      <div class="col-lg-12">
        <p>© 2023 ACM Amritapuri All Rights Reserved. Made with ❤️ in India.</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>